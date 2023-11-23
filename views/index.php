<script type="text/javascript" charset="utf-8" src="js/city_filter.js"></script>

<h1>PHP Test Application</h1>

<label for="filterInput">Filter by City:</label>
<!-- TODO: add pagination -->
<div class="container mt-5">
    <input type="text" id="filterInput" onkeyup="cityFilter()" placeholder="Filter city...">
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
        <?php foreach ($users as &$user): ?>
            <tr>
                <td><?= $user->getName() ?></td>
                <td><?= $user->getEmail() ?></td>
                <td><?= $user->getCity() ?></td>
                <td><?= $user->getPhone() ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <form class="form-horizontal">
        <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="name" id="name"/>
            </div>
        </div>

        <div class="form-group">
            <label for="email" class="col-sm-2 control-label">E-mail:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="email" id="email"/>
            </div>
        </div>

        <div class="form-group">
            <label for="city" class="col-sm-2 control-label">City:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="city" id="city"/>
            </div>
        </div>

        <div class="form-group">
            <label for="phone" class="col-sm-2 control-label">Phone:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="phone" id="phone"/>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="button" class="btn btn-primary" id="submitBtn">Create new row</button>
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(() => {
        $("#submitBtn").click(() => {
            const name = $("#name").val();
            const email = $("#email").val();
            const city = $("#city").val();
            const phone = $("#phone").val();

            // TODO: add frontend validation here
            if (name === '' || email === '') {
                // TODO: print this to filed nex tot ht e
                alert('Please fill in all required fields.');
                return;
            }

            // Make AJAX request
            $.ajax({
                type: "POST",
                url: "create.php",
                data: {
                    name: name,
                    email: email,
                    city: city,
                    phone: phone
                },
                success: (r) => {
                    // TODO: redraw the user view with data we just received
                    console.log(r)
                    window.location.reload();
                },
                error: (r) => {
                    // TODO: propagate data from error to error box
                    console.log(r);
                }
            });
        });
    });
</script>