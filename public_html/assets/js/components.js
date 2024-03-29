document.addEventListener('alpine:init', () => {
	Alpine.data('permissions', () => ({
		permissionState: '',
		step: 0,
		init() {
			this.$watch('permissionState', (value, oldValue) => {
				if (value === 'granted') {
					this.step++;
					this.permissionState = oldValue;
				}
			});
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
		async completeOnboarding() {
			const user = {
				id: await this.getLoggedUser(),
				is_profile_setup: 1,
			};

			const payload = {
				url: '/v1/user',
				method: 'PUT',
				data: {
					user: user,
				},
			};

			const [response, error] = await useFetch(payload);

			console.log(response, error);
			window.location.replace('/capture');
		},
		async getLoggedUser() {
			const payload = {
				url: '/v1/user/getUser',
				method: 'GET',
				data: null,
			};

			const [response, error] = await useFetch(payload);

			if (response.status === 200) return response.data.id;
		},
	}));

	Alpine.data('initCamera', () => ({
		isCameraOn: false,
		isFlashOn: false,
		facingMode: 'environment',
		stream: '',
		init() {
			this.startStream(this.facingMode);
		},
		async startStream(facingMode) {
			const deviceId = await this.getDeviceId();

			if (!deviceId) {
				console.log('NO HAY CAMARA');
				return;
			}

			const constraints = {
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
					facingMode: {
					  exact: facingMode
					},
				},
				deviceId: {
					exact: deviceId,
				},
			};

			const stream = await navigator.mediaDevices.getUserMedia(
				constraints
			);
			this.$refs.video.srcObject = stream;
			this.isCameraOn = true;
			this.stream = stream;
		},
		async getDeviceId() {
			const devices = await navigator.mediaDevices.enumerateDevices();
			const videoDevices = devices.filter(
				(device) => device.kind === 'videoinput'
			);

			return videoDevices.length ? videoDevices[0].deviceId : '';
		},
		toggleFlash() {
			this.isFlashOn = !this.isFlashOn;
			const track = this.stream.getVideoTracks()[0];
			const imageCapture = new ImageCapture(track);
			imageCapture.getPhotoCapabilities().then(() => {
				track.applyConstraints({
					advanced: [{ torch: this.isFlashOn }],
				});
			});
		},
		toggleFacingMode() {
			if (this.facingMode === 'environment') this.facingMode = 'user';
			else this.facingMode = 'environment';

			this.startStream(this.facingMode);
		},
	}));

	Alpine.data('captureIssue', () => ({
		canvas: '',
		video: '',
		picture: '',
		location: '',
		reporter: '',
		init() {
			this.canvas = this.$refs.canvas;
			this.video = this.$refs.video;
		},
		async captureIssue() {
			this.picture = this.takePicture();
			this.location = await this.getLocation();
			this.reporter = await this.getLoggedUser();
			this.$dispatch('issue', {
				picture: this.picture,
				location: this.location,
				reporter: this.reporter,
			});
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
					(error) => reject(error),
					{ enableHighAccuracy: true }
				);
			});
		},
		async getLoggedUser() {
			const payload = {
				url: '/v1/user/getUser',
				method: 'GET',
				data: null,
			};

			const [response, error] = await useFetch(payload);

			if (response.status === 200) return response.data.id;
		},
	}));

	Alpine.data('handleIssue', () => ({
		categories: [],
		picture: '',
		location: '',
		reporter: '',
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
				reporter: this.reporter,
			};

			const payload = {
				url: '/v1/issue',
				method: 'POST',
				data: {
					issue: issue,
				},
			};

			const [response, error] = await useFetch(payload);

			if (response.status === 201) this.step = this.statusType.success;
			else this.step = this.statusType.error;

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
		},
	}));

	Alpine.data('bottomNavbar', () => ({
		navbar: document.querySelector('#bottom-navbar'),
		// init() {
		// 	const { pathname } = window.location;

		// 	if (pathname === '/' || pathname === '/capture')
		// 		this.navbar.classList.add('animate__slideOutDown');
		// 	else this.navbar.classList.add('animate__slideInUp');
		// },
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
		issue: '',
		reporter: '',
		isLoading: true,
		init() {
			this.buildMap();
			this.placeMarkers();
		},
		buildMap() {
			const map = L.map('map', {
				zoomControl: false,
				zoomAnimation: false,
			}).fitWorld();

			L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
				attribution:
					'&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
			}).addTo(map);

			map.locate({ setView: true, maxZoom: 18 });

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
				for (const issue of issues) {
					const marker = this.addIssueMarker(issue);
					markers.addLayer(marker);
				}
				this.map.addLayer(markers);
			}
		},
		addIssueMarker(issue) {
			const icon = L.divIcon({
				className: 'issue-marker-wrapper',
				html: `
          <div class="issue-marker shadow-lg"></div>
          <i class="${issue.category_icon}"></i>
        `,
				iconSize: [40, 42],
			});

			const marker = L.marker([issue.latitude, issue.longitude], {
				icon: icon,
			});

			marker.on('click', async (e) => {
				const issueModalRef = this.$refs.issueModal;
				const issueModal = bootstrap.Modal.getOrCreateInstance(issueModalRef);
				const picturePath = issueModalRef.dataset.picturePath;
				const profileImagePath = issueModalRef.dataset.profileImagePath;
				issueModal.show();
				const { lat, lng } = e.latlng;

				this.issue = issue;
				this.issue.pictureFullPath = picturePath + this.issue.picture;
				this.issue.relativeDate = getRelativeTimeString(
					this.issue.created_date,
					'es-ES'
				);
				const reporter = await this.getIssueReporter(this.issue.reporter);
				this.reporter = reporter;
				this.reporter.fullName = `${this.reporter.name} ${this.reporter.last}`;
				this.reporter.profileImage = profileImagePath + this.reporter.image;

				// const issueDisplayAddress = await this.getIssueDisplayAddress(lat, lng);
				// this.issue.address = issueDisplayAddress.display_name
				// 	.split(',')
				// 	.slice(0, issueDisplayAddress.display_name.split(',').length - 2);

				if (reporter) this.isLoading = false;

				issueModalRef.addEventListener('hidden.bs.modal', () => {
					this.isLoading = true;
					this.issue = '';
					this.reporter = '';
				});
			});

			return marker;
		},
		async getIssueReporter(reporter) {
			const payload = {
				url: `/v1/user/getUser?id=${reporter}`,
				method: 'GET',
				data: null,
			};

			const [response, error] = await useFetch(payload);

			if (response.status === 200) return response.data;
		},
		// async getIssueDisplayAddress(lat, lng) {
		// 	const payload = {
		// 		url: `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`,
		// 		method: 'GET',
		// 		data: null,
		// 	};
		// 	const [response, error] = await useFetch(payload);

		// 	if (response) return response;
		// 	else return error;
		// },
	}));

	Alpine.data('editProfile', () => ({
		id: '',
		name: '',
		last: '',
		password: '',
		confirmPassword: '',
		async init() {
			const user = await this.getUser();
			this.id = user.data.id;
			this.name = user.data.name;
			this.last = user.data.last;
		},
		async getUser() {
			const payload = {
				url: `/v1/user/getUser`,
				method: 'GET',
				data: null,
			};

			const [response, error] = await useFetch(payload);

			return response;
		},
		async updateProfile() {
			const user = {
				id: this.id,
				name: this.name,
				last: this.last,
				password: this.password,
			};

			const payload = {
				url: `/v1/user/updateProfile`,
				method: 'PUT',
				data: {
					user: user,
				},
			};

			const [response, error] = await useFetch(payload);

			if (response.status === 200) document.location.reload();
		},
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
			body: params.data ? JSON.stringify(params.data) : null,
		});
	}

	function buildHeaders(method) {
		const headers = new Headers();
		headers.append('Content-Type', 'application/json');
		if (method !== 'GET') headers.append('X-Requested-With', 'XMLHttpRequest');
		return headers;
	}

	function getCsrf(csrfValue) {
		const csrfSelector = document.querySelector('.csrf');
		if (csrfValue) csrfSelector.value = csrfValue;
		const csrfName = csrfSelector.attributes.name.value;
		const csrfHash = csrfSelector.value;
		return { csrfName: csrfName, csrfHash: csrfHash };
	}

	/**
	 * Convert a date to a relative time string, such as
	 * "a minute ago", "in 2 hours", "yesterday", "3 months ago", etc.
	 * using Intl.RelativeTimeFormat
	 * https://www.builder.io/blog/relative-time
	 */
	function getRelativeTimeString(unparsedDate, lang) {
		let date = unparsedDate.replace(/[-]/g, '/');
		date = Date.parse(date);
		date = new Date(date);

		const timeMs = typeof date === 'number' ? date : date.getTime();
		const deltaSeconds = Math.round((timeMs - Date.now()) / 1000);
		const cutoffs = [
			60,
			3600,
			86400,
			86400 * 7,
			86400 * 30,
			86400 * 365,
			Infinity,
		];
		const units = ['second', 'minute', 'hour', 'day', 'week', 'month', 'year'];
		const unitIndex = cutoffs.findIndex(
			(cutoff) => cutoff > Math.abs(deltaSeconds)
		);
		const divisor = unitIndex ? cutoffs[unitIndex - 1] : 1;
		const rtf = new Intl.RelativeTimeFormat(lang, { numeric: 'auto' });
		return rtf.format(Math.floor(deltaSeconds / divisor), units[unitIndex]);
	}

	const lightbox = GLightbox({
		selector: '.glightbox',
		width: 1200,
		height: 900,
	});
});
