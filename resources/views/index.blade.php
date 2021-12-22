<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <title>Dynamic Query Builder - Users</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">

        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{ asset('css/styles.css') }}" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a class="navbar-brand" href="#page-top">Dynamic Query Builder - Users</a>
            </div>
        </nav>
        <!-- Portfolio Section-->
        <section class="page-section portfolio" id="portfolio">
            <div class="container">
                <form action="/users" method="GET">
                    <br/>
                    <div class="text-right">
                        <button type="button" class="btn btn-primary duplicate">+</button>
                        <input type="submit" class="btn btn-primary" value="Search">
                    </div>
                    <br>
                    @if(isset($filter))
                        @foreach($filter as $row)
                            <div class="row row{{$loop->iteration}}">
                                <div class="form-group col-md-3">
                                    <label>User Data</label>
                                    <select name="filter[{{$loop->iteration}}][col]" class="form-control col">
                                        <option selected>Choose...</option>
                                        <option value="id" @if($row['col'] == 'id') selected @endif>ID</option>
                                        <option value="first_name" @if($row['col'] == 'first_name') selected @endif>First Name</option>
                                        <option value="last_name" @if($row['col'] == 'last_name') selected @endif>Last Name</option>
                                        <option value="full_name" @if($row['col'] == 'full_name') selected @endif>Full Name</option>
                                        <option value="gender" @if($row['col'] == 'gender') selected @endif>Gender</option>
                                        <option value="num_msgs" @if($row['col'] == 'num_msgs') selected @endif>Number of Messages</option>
                                        <option value="age" @if($row['col'] == 'age') selected @endif>Age</option>
                                        <option value="creation_date" @if($row['col'] == 'creation_date') selected @endif>Creation Date</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label>Operator</label>
                                    <select name="filter[{{$loop->iteration}}][operator]" class="form-control operator">
                                        <option selected>Choose...</option>
                                        <option value="=" @if($row['operator'] == '=') selected @endif>=</option>
                                        <option value="!=" @if($row['operator'] == '!=') selected @endif>!=</option>
                                        <option value=">" @if($row['operator'] == '>') selected @endif> > </option>
                                        <option value="<" @if($row['operator'] == '<') selected @endif> < </option>
                                        <option value="startswith" @if($row['operator'] == 'startswith') selected @endif> starts with </option>
                                        <option value="endswith" @if($row['operator'] == 'endswith') selected @endif> ends with </option>
                                        <option value="contains" @if($row['operator'] == 'contains') selected @endif> contains </option>
                                        <option value="exact" @if($row['operator'] == 'exact') selected @endif> exact </option>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="value">Value</label>
                                    <input type="text" class="form-control value" name="filter[{{$loop->iteration}}][value]" value="{{$row['value']}}">
                                </div>
                                <div class="form-group col-md-2">
                                    @if($loop->iteration > 1)
                                        <label>Join</label>
                                        <select class="form-control" name="filter[{{$loop->iteration}}][join]">
                                            <option value="and" @if(!isset($row['join'])) selected @endif>AND</option>
                                            <option value="or" @if(isset($row['join']) && $row['join'] == 'or') selected @endif>OR</option>
                                        </select>
                                    @endif
                                </div>
                                <div class="form-group col-md-1"><input type="button" class="btn btn-danger remove" name="{{$loop->iteration}}" value="x"> </div>

                            </div>
                            <br>
                        @endforeach
                    @else
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label>User Data</label>
                            <select name="filter[1][col]" class="form-control col">
                                <option selected>Choose...</option>
                                <option value="id">ID</option>
                                <option value="first_name">First Name</option>
                                <option value="last_name">Last Name</option>
                                <option value="full_name">Full Name</option>
                                <option value="gender">Gender</option>
                                <option value="num_msgs">Number of Messages</option>
                                <option value="age">Age</option>
                                <option value="creation_date">Creation Date</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Operator</label>
                            <select name="filter[1][operator]" class="form-control operator">
                                <option selected>Choose...</option>
                                <option value="=">=</option>
                                <option value="!=">!=</option>
                                <option value=">"> > </option>
                                <option value="<"> < </option>
                                <option value="startswith"> starts with </option>
                                <option value="endswith"> ends with </option>
                                <option value="contains"> contains </option>
                                <option value="exact"> exact </option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="value">Value</label>
                            <input type="text" class="form-control value" name="filter[1][value]">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Join</label>
                        </div>

                    </div>
                    <br>
                    @endif
                </form>
                @isset($filter)
                    <hr>
                    <table class="table table-bordered table-striped table-delete-action" id="users">
                        <thead>
                        <tr>
                            <th class="text-center">ID</th>
                            <th class="text-center">First Name</th>
                            <th class="text-center">Last Name</th>
                            <th class="text-center">Full Name</th>
                            <th class="text-center">Gender</th>
                            <th class="text-center">Number of messages</th>
                            <th class="text-center">Age</th>
                            <th class="text-center">Creation Date</th>
                        </tr>
                        </thead>

                    </table>
                    <hr>
                    <div class="row">
                    <div class="col-md-6">
                        <canvas id="monthChart"></canvas>
                    </div>
                    <div class="col-md-6" >
                        <canvas id="ageChart"></canvas>
                    </div>
                    <div class="col-md-4" style="position:relative; left:50%; transform:translateX(-50%); margin-top: 20px;">
                        <canvas id="genderChart"></canvas>
                    </div>
                </div>
                @endisset
            </div>
        </section>

       <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- jquery -->
        <script src="{{ asset('js/jquery.min.js') }}"></script>

        <!-- Core theme JS-->
        <script src="{{ asset('js/scripts.js') }}"></script>
        @include('includes.dynamicRows')
        @isset($filter)
            <!-- datatable -->
            <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
            @include('includes.userDatatable')
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            @include('includes.userCharts')
        @endisset
    </body>
</html>
