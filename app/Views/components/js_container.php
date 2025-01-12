<!-- Jquery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Axios CDN -->
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<!-- DataTables CDN -->
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<!-- CryptoJS CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.0.0/crypto-js.min.js"></script>
<!-- Chosen CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

<script>
    $(document).ready(function() {
        const originalAddEventListener = EventTarget.prototype.addEventListener;

        EventTarget.prototype.addEventListener = function(type, listener, options) {
            const isTouchEvent = ['touchstart', 'touchmove', 'mousewheel', 'wheel'].includes(type);

            if (isTouchEvent && (!options || typeof options !== 'object')) {
                options = options || {};
                options.passive = true;
            }

            originalAddEventListener.call(this, type, listener, options);
        };

        $(".chosen-select").chosen({
            width: "100%"
        });
    });
</script>

