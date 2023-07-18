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
    isCameraOn: false,
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
      this.isCameraOn = true;
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
    categories: [],
    picture: '',
    location: '',
    categoryId: '',
    step: 0,
    statusType: {
      success: 2,
      error: 3,
    },
    async saveIssue() {
      const issue = {
        category: this.categoryId,
        picture: this.picture,
        latitude: this.location.lat,
        longitude: this.location.long,
      };

      const payload = {
        url: '/v1/issue',
        method: 'POST',
        data: {
          issue: issue
        }
      };

      const [response, error] = await useFetch(payload);

      if (response.status === 201)
        this.step = this.statusType.success;
      else
        this.step = this.statusType.error;

      console.log(response, error);
    },
    closeModal() {
      const issueModal = bootstrap.Modal.getInstance(this.$refs.issueModal);
      issueModal.hide();
      this.step = 0;
    },
    async getCategories() {
      const payload = {
        url: '/v1/category',
        method: 'GET',
        data: null,
      };

      const [response, error] = await useFetch(payload);

      if (response.status === 200) {
        this.categories = response.data;
      }
    }
  }));

  Alpine.data('bottomNavbar', () => ({
    navbar: document.querySelector('#bottom-navbar'),
    init() {
      const { pathname } = window.location;

      if (pathname === '/' || pathname === '/capture')
        this.navbar.classList.add('animate__slideOutDown');
      else
        this.navbar.classList.add('animate__slideInUp');
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

  Alpine.data('initMap', () => ({
    map: '',
    async init() {
      this.buildMap();
      await this.placeMarkers();
    },
    buildMap() {
      const map = L.map('map', { 
        zoomControl: false,
        zoomAnimation: false,
      }).fitWorld();
  
      L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
      }).addTo(map);
  
      map.locate({ setView: true, maxZoom: 16 });
  
      this.map = map;
    },
    async placeMarkers() {
      let issues = [];
      const payload = {
        url: '/v1/issue',
        method: 'GET',
        data: null,
      };

      const [response, error] = await useFetch(payload);

      if (response.status === 200) {
        issues = response.data;
        const markers = L.markerClusterGroup({ maxClusterRadius: 200 });
        for (const iterator of issues) {
          markers.addLayer(L.marker([ iterator.latitude, iterator.longitude ]));
        }
        this.map.addLayer(markers);
      }
    }
  }));

  async function useFetch(payload) {
    try {
      if (payload.method !== 'GET') {
        const { csrfName, csrfHash } = getCsrf();
        payload.data[csrfName] = csrfHash;
      }

			const source = await fetch(buildRequest(payload));
			const response = await source.json();
			getCsrf(response.token);
			return [response, null];
		} catch (error) {
			console.log(error);
			return [null, error];
		}
	}

  function buildRequest(params) {
    return new Request(params.url, {
      method: params.method,
      headers: buildHeaders(params.method),
      body: params.data ? JSON.stringify(params.data) : null
    });
  }

  function buildHeaders(method) {
    const headers = new Headers();
    headers.append('Content-Type', 'application/json');
    if (method !== 'GET')
      headers.append('X-Requested-With', 'XMLHttpRequest');
    return headers;
  }

	function getCsrf(csrfValue) {
		const csrfSelector = document.querySelector('.csrf');
		if (csrfValue) csrfSelector.value = csrfValue;
		const csrfName = csrfSelector.attributes.name.value;
		const csrfHash = csrfSelector.value;
		return { csrfName: csrfName, csrfHash: csrfHash };
	}
});
