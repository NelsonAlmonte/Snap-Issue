document.addEventListener('alpine:init', () => {

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
