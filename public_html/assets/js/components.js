document.addEventListener('alpine:init', () => {

  Alpine.data('permissions', () => ({
    permissionsToValidate: [
      { name: 'camera' }, { name: 'geolocation' },
    ],
    async checkPermission(type) {
      const permission = await navigator.permissions.query({ name: type });
      console.log(permission);

      const payload = {
        type: type,
        state: permission.state,
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
        console.log('tiene permiso');
          // TODO: Continuar
          break;
        case 'prompt':
          try {
            await payload.method;
          } catch (error) {
            console.log(error);
            //TODO: Mostrar mensaje de que no tiene permiso o no hay camara
          }
          break;
        case 'denied':
          console.log('Negaste el permiso, por favor acepta de nuevo');
          // TODO: Mostrar mensaje de que no tiene permiso
          break;
      }
    },
    initCamera() {
      return navigator.mediaDevices.getUserMedia({ video: true });
    },
    initLocation() {
      return new Promise((resolve, reject) => {
        navigator.geolocation.getCurrentPosition(
          (position) => resolve(position),
          (error) => reject(error)
        );
      });
    },
    async validatePermissions() {
      const validationTarget = 2;
      let successfullValidations = 0;
      
      for (const permission of this.permissionsToValidate) {
        let foo = await navigator.permissions.query({ name: permission.name });
        if (foo.state === 'granted') successfullValidations ++;
        console.log(foo);
      }

      if (validationTarget === successfullValidations) {
        console.log('siuuu');
      } else {
        console.log('Acepte los demas permisos');
      }
    }
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
    async checkPermission() {
      const permission = await navigator.permissions.query({ name: 'camera' });
      this.handlePermission(permission.state);
  
      permission.addEventListener('change', (event) => {
        console.log(event.currentTarget.state);
        this.handlePermission(event.currentTarget.state);
      });
    },
    async handlePermission(state) {
      switch (state) {
        case 'granted':
          this.startStream();
          break;
        case 'prompt':
          try {
            await navigator.mediaDevices.getUserMedia(this.initialConstraints);
          } catch (error) {
            console.log(error);
            //TODO: Mostrar mensaje de que no tiene permiso o no hay camara
          }
          break;
        case 'denied':
          console.log('Negaste el permiso, por favor acepta de nuevo');
          // TODO: Mostrar mensaje de que no tiene permiso
          break;
      }
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
