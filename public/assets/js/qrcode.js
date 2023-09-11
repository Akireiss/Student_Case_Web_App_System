document.getElementById('saveImageButton').addEventListener('click', function() {
    const qrCodeImage = document.querySelector('.w-48.h-48');
    const scaleFactor = 2;

    const canvas = document.createElement('canvas');
    canvas.width = qrCodeImage.width * scaleFactor;
    canvas.height = qrCodeImage.height * scaleFactor;
    const context = canvas.getContext('2d');
    context.drawImage(qrCodeImage, 0, 0, canvas.width, canvas.height);
    const dataURL = canvas.toDataURL('image/png', 1.0);
    const link = document.createElement('a');
    link.href = dataURL;
    link.download = 'qr_code.png';
    link.click();
});
