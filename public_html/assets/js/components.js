document.addEventListener('alpine:init', () => {

  Alpine.data('permissions', () => ({
    permissionState: '',
    step: 0,
    init() {
      this.$watch('permissionState', (value, oldValue) => {
        if (value === 'granted') {
          this.step ++;
          this.permissionState = oldValue;
        }
      })
    },
    async checkPermission(type) {
      const state = await this.getPermissionState(type);

      const payload = {
        type: type,
        state: state,
      };
      if (type === 'camera') {
        payload.method = this.initCamera;
      } else {
        payload.method = this.initLocation;
      }

      this.handlePermission(payload);
    },
    async handlePermission(payload) {
      switch (payload.state) {
        case 'granted':
          this.permissionState = await this.getPermissionState(payload.type);
          console.log('tiene permiso');
          // TODO: Continuar
          break;
        case 'prompt':
          try {
            await payload.method();
            this.permissionState = await this.getPermissionState(payload.type);
          } catch (error) {
            this.permissionState = await this.getPermissionState(payload.type);
            console.log(error);
            //TODO: Mostrar mensaje de que no tiene permiso o no hay camara
          }
          break;
        case 'denied':
          this.permissionState = await this.getPermissionState(payload.type);
          console.log('Negaste el permiso, por favor acepta de nuevo');
          // TODO: Mostrar mensaje de que no tiene permiso
          break;
      }
    },
    async getPermissionState(type) {
      const permission = await navigator.permissions.query({ name: type });
      return permission.state;
    },
    async initCamera() {
      const stream = await navigator.mediaDevices.getUserMedia({ video: true });
      stream.getTracks().forEach((track) => track.stop());
    },
    initLocation() {
      return new Promise((resolve, reject) => {
        navigator.geolocation.getCurrentPosition(
          (position) => resolve(position),
          (error) => reject(error)
        );
      });
    },
  }));

	Alpine.data('initCamera', () => ({
    initialConstraints: {
      video: {
        width: {
          min: 1280,
          ideal: 1920,
          max: 2560,
        },
        height: {
          min: 720,
          ideal: 1080,
          max: 1440,
        },
        // facingMode: {
        //   exact: 'environment'
        // },
      },
    },
    init() {
      this.startStream();
    },
    async startStream() {
      const deviceId = await this.getDeviceId();
  
      if (!deviceId) {
        console.log('NO HAY CAMARA');
        return;
      }
  
      const updatedConstraints = {
        ...this.initialConstraints,
        deviceId: {
          exact: deviceId,
        },
      };
  
      const stream = await navigator.mediaDevices.getUserMedia(
        updatedConstraints
      );
      this.$refs.video.srcObject = stream;
    },
    async getDeviceId() {
      const devices = await navigator.mediaDevices.enumerateDevices();
      const videoDevices = devices.filter(
        (device) => device.kind === 'videoinput'
      );
  
      return videoDevices.length ? videoDevices[0].deviceId : '';
    },
  }));

  Alpine.data('captureIssue', () => ({
    canvas: '',
    video: '',
    picture: '',
    location: '',
    init() {
      this.canvas = this.$refs.canvas;
      this.video = this.$refs.video;
    },
    async captureIssue() {
      this.picture = this.takePicture();
      this.location = await this.getLocation();
      this.$dispatch('issue', { picture: this.picture, location: this.location })
    },
    takePicture() {
      this.canvas.width = this.video.videoWidth;
      this.canvas.height = this.video.videoHeight;
      this.canvas.getContext('2d').drawImage(this.video, 0, 0);
      return this.canvas.toDataURL('image/jpeg');
    },
    async getLocation() {
      const position = await this.getCurrentPosition();
      return {
        lat: position.coords.latitude,
        long: position.coords.longitude,
      };
    },
    getCurrentPosition() {
      return new Promise((resolve, reject) => {
        navigator.geolocation.getCurrentPosition(
          (position) => resolve(position),
          (error) => reject(error)
        );
      });
    },
  }));

  Alpine.data('handleIssue', () => ({
    picture: '',
    location: '',
    category: 1,
    step: 0,
    async saveIssue() {
      const issue = {
        category: this.category,
        picture: this.picture,
        latitude: this.location.lat,
        longitude: this.location.long,
      };

      const payload = {
        url: '/v1/issue',
        issue: issue
      };

      const [response, error] = await useFetch(payload);

      if (response.status === 201)
        this.step = 2;        
      else
        this.step = 3;

      console.log(response, error);
      getCsrf(response.token);
    },
    selectCategory(el) {
      console.log(el);
    },
    closeModal() {
      const issueModal = bootstrap.Modal.getInstance(this.$refs.issueModal);
      issueModal.hide();
      this.step = 0;
      this.category = '';
    }
  }));

  Alpine.data('bottomNavbar', () => ({
    navbar: document.querySelector('#bottom-navbar'),
    init() {
      const { pathname } = window.location;

      if (pathname === '/' || pathname === '/capture') {
        this.navbar.classList.add('animate__slideOutDown');
      } else {
        this.navbar.classList.add('animate__slideInUp');
      }
    },
    toggle() {
      const navbarClasses = Array.from(this.navbar.classList);
      if (navbarClasses.includes('animate__slideOutDown')) {
        this.navbar.classList.remove('animate__slideOutDown');
        this.navbar.classList.add('animate__slideInUp');
      } else {
        this.navbar.classList.remove('animate__slideInUp');
        this.navbar.classList.add('animate__slideOutDown');
      }
    },
  }));

  async function useFetch(payload) {
		try {
			const { csrfName, csrfHash } = getCsrf();
			payload[csrfName] = csrfHash;

			const source = await fetch(payload.url, {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
					'X-Requested-With': 'XMLHttpRequest',
				},
				body: JSON.stringify(payload),
			});
			const response = await source.json();
			getCsrf(response.token);
			return [response, null];
		} catch (error) {
			console.log(error);
			return [null, error];
		}
	}

	function getCsrf(csrfValue) {
		const csrfSelector = document.querySelector('.csrf');
		if (csrfValue) csrfSelector.value = csrfValue;
		const csrfName = csrfSelector.attributes.name.value;
		const csrfHash = csrfSelector.value;
		return { csrfName: csrfName, csrfHash: csrfHash };
	}
});
