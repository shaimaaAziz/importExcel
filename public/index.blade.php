<html>

<head>

    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-route.js"></script>

    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons"/>


</head>

<body style="direction: rtl" ng-app="myApp">
    <div class="container" ng-controller="importController" >
        <div class="container-fluid">
            <div class="text-center m-5">
                <button class="btn btn-outline-secondary btn-md" id="data">تحميل كشف الدفعات </button>
            </div>

            <div id="excelView">

                <div class="alert alert-danger" ng-if="errors.length > 0" class="close"
                     data-dismiss="alert" aria-label="Close">
                    <span ng-repeat="error in errors"><i class="material-icons">close</i> {{ error }}</span>
                </div>

                <fieldset  style="width:40em" class="border p-3 m-3">
                    <legend  class="w-auto" style="color:#fa8282;font-weight:bold; text-align: right">كشف الدفعات </legend>
                   <form method="post" enctype="multipart/form-data">
                       <div>
                         <label class="mr-0">الملف</label>
                           <input class="mr-5" type="file" name="import_file" id="import_file" accept="file"
                                  ng-model="import_file">
                            <button class="btn btn-md btn-danger" ng-click="importExcel()">تحميل</button>
                       </div>
                   </form>
                </fieldset>
        </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {

            $("#excelView").hide();

            $('#data').click(function ( ) {
                $("#excelView").show();
            })
        });


    </script>
</body>


</html>



