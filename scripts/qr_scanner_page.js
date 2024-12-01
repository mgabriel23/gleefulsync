$(document).ready(function() {
    let html5QrCode = null; // Initialize as null
    let isScannerActive = false; // Track scanner state

    function startScanner() {
        const config = { fps: 5, qrbox: { width: 200, height: 200 } };

        $('#reader').show();

        // Check if html5QrCode is already initialized
        if (!html5QrCode) {
            html5QrCode = new Html5Qrcode("reader", { formatsToSupport: [ Html5QrcodeSupportedFormats.QR_CODE ] });
        }

        // Start the scanner only if it's not already active
        if (!isScannerActive) {
            html5QrCode.start({ facingMode: "environment" }, config, qrCodeSuccessCallback)
                .then(() => {
                    console.log("QR code scanner started successfully");
                    isScannerActive = true;
                })
                .catch((err) => {
                    console.error("Failed to start QR code scanner:", err);
                });
        }
    }

    function stopScanner() {
        if (html5QrCode && isScannerActive) {
            html5QrCode.stop().then(() => {
                console.log("QR code scanner stopped successfully");
                isScannerActive = false;
                html5QrCode.clear();
                html5QrCode = null;
                $('#reader').hide();
                $('#start-scanner').show();
            }).catch((err) => {
                console.error("Failed to stop QR code scanner:", err);
            });
        }
    }

    function saveAttendance(attendee) {
        alert(attendee);
        /*
        $.ajax({
            url: '/gleefulsync/api/attendance_api.php',
            method: 'POST',
            data: { action: "saveAttendanceViaQR", username: attendee },
            success: function(response) {
                const timestamp = new Date().toLocaleString('en-US', {
                    weekday: 'long', // Full weekday name (e.g., Monday)
                    year: 'numeric', // Four-digit year (e.g., 2024)
                    month: 'long', // Full month name (e.g., July)
                    day: 'numeric', // Numeric day of the month (e.g., 2)
                    hour: 'numeric', // Numeric hour (e.g., 10)
                    minute: 'numeric', // Numeric minute (e.g., 30)
                });

                setModalHeader('QR SCAN RESULT', 'Attendance Details');

                if(response.message) {
                    $('#label-desc').text('Successfully recorded attendance for:');
                } else {
                    $('#label-desc').text('There was an error encountered for:');
                }

                $('#attendance-result').text(attendee);
                $('#attendance-timestamp').text(timestamp);

                $("#modal").show();
            },
            error: function(xhr, status, error) {
                console.error('Error fetching data:', error);
                return 'Error!';
            }
        });
        */
    }

    const qrCodeSuccessCallback = (decodedText, decodedResult) => {
        const attendeeName  = decodedText;

        stopScanner();
        saveAttendance(attendeeName);

        $('#close-modal').click(function() {
            $("#modal").hide();
        });
    };

    // Event listener for the start scanner button
    $(document).on('click', '#start-scanner', function() {
        // $('#start-scanner').hide();

        // Ask for camera permissions
        navigator.mediaDevices.getUserMedia({ video: { facingMode: "environment" } })
            .then(function(stream) {
                // Permission granted, start the scanner
                startScanner();
            })
            .catch(function(err) {
                // Handle permission denied or other errors
                console.error('Failed to get camera access:', err);
                alert('Failed to access camera. Please grant permission to use the QR code scanner.');
                $('#start-scanner').show(); // Show the start button again
            });
    });

    // Additional check for mobile devices to prevent auto-start
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        // Show the start button initially to ensure the user initiates camera access
        $('#start-scanner').show();
    }
});