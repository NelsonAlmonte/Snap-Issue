(function () {
	const playButton = document.querySelector('.play');
	const takePictureButton = document.querySelector('.take-picture');
	const video = document.querySelector('video');
	const canvas = document.querySelector('canvas');
	const picture = document.querySelector('.picture');

	const initialConstraints = {
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
	};

	playButton.onclick = async () => {
		await checkPermission();
	};

	async function startStream() {
		const deviceId = await getDeviceId();

		if (!deviceId) {
			console.log('NO HAY CAMARA');
			return;
		}

		const updatedConstraints = {
			...initialConstraints,
			deviceId: {
				exact: deviceId,
			},
		};

		const stream = await navigator.mediaDevices.getUserMedia(
			updatedConstraints
		);
		video.srcObject = stream;
	}

	async function getDeviceId() {
		const devices = await navigator.mediaDevices.enumerateDevices();
		const videoDevices = devices.filter(
			(device) => device.kind === 'videoinput'
		);

		return videoDevices.length ? videoDevices[0].deviceId : '';
	}

	async function checkPermission() {
		const permission = await navigator.permissions.query({ name: 'camera' });
		handlePermission(permission.state);

		permission.addEventListener('change', (event) => {
			console.log(event.currentTarget.state);
			handlePermission(event.currentTarget.state);
		});
	}

	async function handlePermission(state) {
		switch (state) {
			case 'granted':
				startStream();
				break;
			case 'prompt':
				try {
					await navigator.mediaDevices.getUserMedia(initialConstraints);
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
	}

	takePictureButton.onclick = () => {
		sendIssue();
	};

	async function sendIssue() {
		const picture = takePicture();
		const position = await getLocation();
		console.log(picture, position);
	}

	function takePicture() {
		canvas.width = video.videoWidth;
		canvas.height = video.videoHeight;
		canvas.getContext('2d').drawImage(video, 0, 0);
		picture.src = canvas.toDataURL('image/jpeg');
		return canvas.toDataURL('image/jpeg');
	}

	async function getLocation() {
		const position = await getCurrentPosition();
		return {
			lat: position.coords.latitude,
			long: position.coords.longitude,
		};
	}

	function getCurrentPosition() {
		return new Promise((resolve, reject) => {
			navigator.geolocation.getCurrentPosition(
				(position) => resolve(position),
				(error) => reject(error)
			);
		});
	}
})();
