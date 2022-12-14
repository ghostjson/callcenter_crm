<script type="text/javascript">
    var updateAreaDiv = $('#update-area');
    var refreshPercent = 0;
    var checkInstall = true;

    $('#update-app').click(function () {
        if ($('#update-frame').length) {
            return false;
        }

        swal({
            title: "{{ trans('app.areYouSure') }}",
            text: "{{ trans('messages.updateBackupNotice') }}",
            dangerMode: true,
            icon: 'warning',
            buttons: {
                cancel: "{{ trans('app.noCancelIt') }}",
                confirm: {
                    text: "{{ trans('messages.yesUpdateIt') }}",
                    value: true,
                    visible: true,
                    className: "danger",
                }
            }
        }).then(function(isConfirm) {
            if (isConfirm) {

                updateAreaDiv.removeClass('hide');

                if (isConfirm) {

                    $.easyAjax({
                        type: 'GET',
                        url: '{!! route("admin2.updateVersion.update") !!}',
                        success: function (response) {
                            if(response.status =='success'){
                                updateAreaDiv.html("<strong>What's New:-</strong><br> " + response.description);
                                downloadScript();
                                downloadPercent();
                            }

                        }
                    });
                }
            }
        });
    });

    function downloadScript() {
        $.easyAjax({
            type: 'GET',
            url: '{!! route("admin2.updateVersion.download") !!}',
            success: function (response) {
                clearInterval(refreshPercent);
                $('#percent-complete').css('width', '100%');
                $('#percent-complete').html('100%');
                $('#download-progress').append("<i><span class='text-success'>Download complete.</span> Now Installing...Please wait (This may take few minutes.)</i>");

                window.setInterval(function () {
                    /// call your function here
                    if (checkInstall == true) {
                        checkIfFileExtracted();
                    }
                }, 1500);

                installScript();

            }
        });
    }

    function getDownloadPercent() {
        $.easyAjax({
            type: 'GET',
            url: '{!! route("admin2.updateVersion.downloadPercent") !!}',
            success: function (response) {
                response = response.toFixed(1);
                $('#percent-complete').css('width', response + '%');
                $('#percent-complete').html(response + '%');
            }
        });
    }

    function checkIfFileExtracted() {
        $.easyAjax({
            type: 'GET',
            url: '{!! route("admin2.updateVersion.checkIfFileExtracted") !!}',
            success: function (response) {
                checkInstall = false;
                if(response.status == 'success'){
                    window.location.reload();
                }
            }
        });
    }

    function downloadPercent() {
        updateAreaDiv.append('<hr><div id="download-progress">' +
            'Download Progress<br><div class="progress progress-lg">' +
            '<div class="progress-bar progress-bar-success active progress-bar-striped" role="progressbar" id="percent-complete" role="progressbar""></div>' +
            '</div>' +
            '</div>'
        );
        //getting data
        refreshPercent = window.setInterval(function () {
            getDownloadPercent();
            /// call your function here
        }, 1500);
    }

    function installScript() {
        $.easyAjax({
            type: 'GET',
            url: '{!! route("admin2.updateVersion.install") !!}',
            success: function (response) {
                if(response.status == 'success'){
                    window.location.reload();
                }
            }
        });
    }

    function getPurchaseData() {
        var token = "{{ csrf_token() }}";
        $.easyAjax({
            type: 'POST',
            url: "{{ route('purchase-verified') }}",
            data: {'_token': token},
            container: "#support-div",
            messagePosition: 'inline',
            success: function (response) {
                window.location.reload();
            }
        });
        return false;
    }
</script>
