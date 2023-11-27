<div class="container">
    <h1>List of Users</h1>

    <div class="row">
        <div class="col-md-5 col-sm-5 col-xs-5">
            <input type="text" id="filterInput" class="form-control" onkeyup="filterTableByRow(2)"
                   placeholder="Filter city...">
        </div>
        <div class="col-md-1 col-md-offset-5 col-sm-1 col-sm-offset-5 col-xs-1 col-xs-offset-5">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#new-record-modal">Add New
            </button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table" id="userTable">
            <thead class="thead-dark">
            <tr>
                <th>Name</th>
                <th>E-mail</th>
                <th>City</th>
                <th>Phone</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($users as $key => $user): ?>
                <tr class="<?php echo $key % 2 === 0 ? "even" : ""; ?>">
                    <td><?= $user->getName() ?></td>
                    <td><?= $user->getEmail() ?></td>
                    <td><?= $user->getCity() ?></td>
                    <td><?= $user->getPhone() ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- modal -->
<div class="modal fade" id="new-record-modal" tabindex="-1" role="dialog" aria-labelledby="modal-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- modal header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="modal-label">Add New User</h4>
            </div>

            <!-- modal body -->
            <div class="modal-body">
                <form class="form-horizontal" id="new-record-form" novalidate>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="name" id="name"/>
                            <small class="text-danger" id="name-error"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="email" class="col-sm-2 control-label">E-mail:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="email" id="email"/>
                            <small class="text-danger" id="email-error"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="city" class="col-sm-2 control-label">City:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="city" id="city"/>
                            <small class="text-danger" id="city-error"></small>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="phone" class="col-sm-2 control-label">Phone:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="phone" id="phone"/>
                            <small class="text-danger" id="phone-error"></small>
                        </div>
                    </div>
                </form>
            </div>

            <!-- modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="resetForm()">
                    Close
                </button>
                <button type="button" class="btn btn-primary" onclick="createNewRecord()">
                    Create new
                </button>
            </div>
        </div>
    </div>
</div>