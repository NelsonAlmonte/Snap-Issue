(function () {
	const playButton = document.querySelector('.play');
	const video = document.querySelector('video');

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
})();
