<!doctype html>
<html lang="en">
<?php require_once dirname(__FILE__, 4) . '/views/universal/signedin/header.php' ?>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php require_once dirname(__FILE__, 4) . '/views/universal/signedin/sidenav.php' ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php require_once dirname(__FILE__, 4) . '/views/universal/signedin/navigation.php' ?>

                <link href="<?= PATH; ?>/dashboard/usr/css/multistep_progressbar.css" rel="stylesheet">

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Donor Contribution</li>
                        </ol>
                    </nav>

                    <div class="row justify-content-center">
                        <div class="col-12 col-sm-11 col-md-10 col-lg-9 col-xl-8 text-center p-0 mt-3 mb-2">
                            <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                                <form id="msform">
                                    <!-- progressbar -->
                                    <ul id="progressbar">
                                        <li class="active" id="account"><strong>Province</strong></li>
                                        <li id="personal"><strong>Pickup Locations</strong></li>
                                        <li id="payment"><strong>Type of Assistance to Provide</strong></li>
                                        <li id="confirm"><strong>Collection Method</strong></li>
                                        <li id="finish"><strong>Finish</strong></li>
                                    </ul>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div> <br> <!-- fieldsets -->
                                    <fieldset>
                                        <div class="form-group">
                                            <label for="select_province">Select Province</label>
                                            <select class="form-control" id="select_province">
                                                <?php foreach ($province as $key => $value) { ?>
                                                    <option value="<?= $value['District'] ?>"><?= $value['District'] ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <?php //echo print_r($province); ?>
                                        <input type="button" name="next" class="next action-button" value="Next" id=""/>
                                    </fieldset>
                                    <fieldset>
                                        <div class="form-group">
                                            <label for="select_location">Select Location</label>
                                            <select class="form-control" id="select_location">
                                                <option>--</option>
                                            </select>
                                        </div>
                                        <input type="button" name="next" class="next action-button" value="Next" />
                                        <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                    </fieldset>
                                    <fieldset>
                                        <select class="form-control" id="select_assistance">
                                            <option value="Education Finances">Education Finances</option>
                                            <option value="Stationary">Stationary</option>
                                            <option value="Clothing">Clothing</option>
                                            <option value="Food">Food</option>
                                            <option value="Crops">Crops</option>
                                        </select>
                                        <input type="button" name="next" class="next action-button" value="Next" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                    </fieldset>
                                    <fieldset>
                                        <select class="form-control" id="select_collection">
                                            <option value="Deliver">Deliver</option>
                                            <option value="Fetch">Fetch</option>
                                        </select>
                                        <input type="button" name="next" class="next action-button" value="Submit" /> <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                    </fieldset>
                                    <fieldset>
                                    <div class="form-card">
                                            <div class="row">
                                                <div class="col-7">
                                                    <h2 class="fs-title">Finish:</h2>
                                                </div>
                                            </div> <br><br>
                                            <h2 class="purple-text text-center"><strong>SUCCESS !</strong></h2> <br>
                                            <div class="row justify-content-center">
                                                <div class="col-3"> <img src="https://i.imgur.com/GwStPmg.png" class="fit-image"> </div>
                                            </div> <br><br>
                                            <div class="row justify-content-center">
                                                <div class="col-7 text-center">
                                                    <h5 class="purple-text text-center">Parcel Successfully Created</h5>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Sizabantu 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="/">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <?php require_once dirname(__FILE__, 4) . '/views/universal/signedin/footer.php' ?>

    <script src="<?= PATH ?>/dashboard/usr/js/multistep_progressbar.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#select_province').change(function(e) {

                var province = $('#select_province').children("option:selected").val();
                var postData = {
                    "province": province
                }
                var url = 'ajax/province.php';
                $.post(url,postData,function(data,status){
                    var result = data.slice(10);
                    var myobj = JSON.parse(result);
                    console.log(myobj);
                    $.each(myobj['result'], function(key,val){
                        console.log("key : "+key+" ; value : "+val.Name);
                        var option = new Option(val.Name, val.Name);
                        $('#select_location').append($(option));
                    });
                });
            });
        });
    </script>

</body>

</html>