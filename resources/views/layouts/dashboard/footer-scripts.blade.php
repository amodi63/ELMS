<!--end::Demo Panel-->
<!--begin::Global Config(global config for global JS scripts)-->
<script>var KTAppSettings = {
        "breakpoints": {"sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400},
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#3699FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#E4E6EF",
                    "dark": "#181C32"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1F0FF",
                    "secondary": "#EBEDF3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#3F4254",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#EBEDF3",
                "gray-300": "#E4E6EF",
                "gray-400": "#D1D3E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#7E8299",
                "gray-700": "#5E6278",
                "gray-800": "#3F4254",
                "gray-900": "#181C32"
            }
        },
        "font-family": "Poppins"
    };</script>
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
<!--end::Global Theme Bundle-->
<!--begin::Page Vendors(used by this page)-->
<!--end::Page Vendors-->
<!--begin::Page Scripts(used by this page)-->
<script src="{{ asset('assets/js/pages/widgets.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.min.js"></script>

<!--end::Page Scripts-->
{{-- <script>
    $(document).ready(function () {
        $('#FirstStatement').summernote();
    });
</script> --}}

<!--end::Global Theme Bundle-->
<!--begin::Page Vendors(used by this page)-->
<script src="{{ asset('assets/plugins/custom/jstree/jstree.bundle.js?v=7.0.3') }}"></script>
<!--end::Page Vendors-->
<!--begin::Page Scripts(used by this page)-->
<script src="{{ asset('assets/js/pages/features/miscellaneous/treeview.js?v=7.0.3') }}"></script>
<!--end::Page Scripts-->
{{-- <script>
    function msg(type, msg) {
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-left",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        toastr[type](msg);
    }

    $(document)
        .ajaxSend(function (event, jqxhr, settings) {
            if (settings.blockUI?.enabled === false) {
                return;
            }

            const target = settings.blockUI?.target ?? 'body';
            $(target).block({
                baseZ: 2000,
                message: 'جاري تنفيذ الامر',
                css: {
                    border: 'none',
                    padding: '15px',
                    backgroundColor: '#000',
                    '-webkit-border-radius': '10px',
                    '-moz-border-radius': '10px',
                    opacity: .5,
                    color: '#fff'
                }
            });
        })
        .ajaxComplete(function (event, jqxhr, settings) {
            if (settings.blockUI?.enabled === false) {
                return;
            }
            const target = settings.blockUI?.target ?? 'body';
            $(target).unblock();
        });
</script>
<script type="module">
    // Import the functions you need from the SDKs you need
    import {initializeApp} from "https://www.gstatic.com/firebasejs/9.14.0/firebase-app.js";
    import {getAnalytics} from "https://www.gstatic.com/firebasejs/9.14.0/firebase-analytics.js";
    import {getMessaging, getToken, onMessage} from "https://www.gstatic.com/firebasejs/9.14.0/firebase-messaging.js";
    import {onBackgroundMessage} from "https://www.gstatic.com/firebasejs/9.2.0/firebase-messaging-sw.js";


    // TODO: Add SDKs for Firebase products that you want to use
    // https://firebase.google.com/docs/web/setup#available-libraries

    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    const firebaseConfig = {
        apiKey: "AIzaSyAfk_mg9a1sWo5pabu58TsrHAMrCyi9QjU",
        authDomain: "policies-protocols-41a94.firebaseapp.com",
        projectId: "policies-protocols-41a94",
        storageBucket: "policies-protocols-41a94.appspot.com",
        messagingSenderId: "796562008615",
        appId: "1:796562008615:web:16486c3f10bc5b2ca1bc02",
        measurementId: "G-9R7CKRWCPF"
    };

    // Initialize Firebase
    const app = initializeApp(firebaseConfig);
    const analytics = getAnalytics(app);

    const messaging = getMessaging(app);
    const vapidKey = "BJnf3bjkSwAYjiiiPbTRqc4ED6oz86z98vodAOMfApc1n7NeWUkyzpB33nyqrEvgdrLW9XETP334k96hu_pONto";

    getToken(messaging, {vapidKey}).then((currentToken) => {
        if (currentToken) {
            console.log("currentToken:", currentToken)
            // Send the token to your server and update the UI if necessary
            // ...
        } else {
            // Show permission request UI
            console.log('No registration token available. Request permission to generate one.');
            // ...
        }
    }).catch((err) => {
        console.log('An error occurred while retrieving token. ', err);
        // ...
    });

    onMessage(messaging, (payload) => {
        debugger;
        console.log('Message received. ', payload);
        // ...
    });

    //
    // onBackgroundMessage(messaging, (payload) => {
    //     debugger;
    //     console.log('[firebase-messaging-sw.js] Received background message ', payload);
    //     // Customize notification here
    //     const notificationTitle = 'Background Message Title';
    //     const notificationOptions = {
    //         body: 'Background Message body.',
    //         icon: '/firebase-logo.png'
    //     };
    //
    //     self.registration.showNotification(notificationTitle,
    //         notificationOptions);
    // });
    //
    // messaging.onBackgroundMessage(function(payload) {
    //     console.log('[firebase-messaging-sw.js] Received background message ', payload);
    //     // Customize notification here
    //     const notificationTitle = 'Title';
    //     const notificationOptions = {
    //         body: payload,
    //         icon: '/firebase-logo.png'
    //     };
    //     self.registration.showNotification(notificationTitle,
    //         notificationOptions);
    // });


    function requesBrowserPermission() {
        console.log('Requesting permission...');
        Notification.requestPermission().then((permission) => {
            if (permission === 'granted') {

            }
        });
    }


    function msg(type, msg) {
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-left",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        toastr[type](msg);
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    requesBrowserPermission();


</script> --}}

@stack('scripts')
