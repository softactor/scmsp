@extends('scmsp.backend.layout.app')
@section('title', 'Create Complain Type')
@section('content')


<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="#">Dashboard</a>
        </li>
    </ol>
    <!-- Icon Cards-->
    <div class="row">
       
    </div>
    <!-- DataTables Example -->
    <div class="card mb-3">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form action="/action_page.php">
                        <div class="form-group">
                            <label for="start_date">Start date:</label>
                            <input autocomplete="off" type="text" class="form-control" id="complainDatepicker"  name="start_date">
                        </div>
                        <div class="form-group">
                            <label for="end_date">End date:</label>
                            <input autocomplete="off" type="text" class="form-control" id="start_date"  name="start_date">
                        </div>
                        <div class="form-group">
                            <label for="pwd">Division:</label>
                            <select class="form-control" id="division" name='division'>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                              </select>
                        </div>
                        <div class="form-group">
                            <label for="pwd">Department:</label>
                            <select class="form-control" id="department" name='department'>
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                              </select>
                        </div>
                        <button type="submit" class="btn btn-default">Submit</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <!-- Grid column -->
                <div class="col-md-6">
                  <!-- Exaple 1 -->
                  <div class="card example-1 scrollbar-deep-purple">
                    <div class="card-body">
                      <h4 id="section1"><strong>New Complain</strong></h4>
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>John</td>
                            <td>Doe</td>
                            <td>john@example.com</td>
                          </tr>
                          <tr>
                            <td>Mary</td>
                            <td>Moe</td>
                            <td>mary@example.com</td>
                          </tr>
                          <tr>
                            <td>July</td>
                            <td>Dooley</td>
                            <td>july@example.com</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <!-- Exaple 1 -->
                </div>
                <div class="col-md-6">
                  <!-- Exaple 1 -->
                  <div class="card example-1 scrollbar-deep-purple">
                    <div class="card-body">
                      <h4 id="section1"><strong>Pending Complain</strong></h4>
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>John</td>
                            <td>Doe</td>
                            <td>john@example.com</td>
                          </tr>
                          <tr>
                            <td>Mary</td>
                            <td>Moe</td>
                            <td>mary@example.com</td>
                          </tr>
                          <tr>
                            <td>July</td>
                            <td>Dooley</td>
                            <td>july@example.com</td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <!-- Exaple 1 -->
                </div>
                <!-- Grid column -->
              </div>
              <!-- Grid row -->
            
        </div>
    </div>

</div>
<!-- /.container-fluid -->
  @endsection