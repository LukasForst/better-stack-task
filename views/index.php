<script type="text/javascript" charset="utf-8" src="js/city_filter.js"></script>

<h1>PHP Test Application</h1>

<label for="filterInput">Filter by City:</label>
<input type="text" id="filterInput" onkeyup="cityFilter()" placeholder="Filter city...">

<table id="userTable">
    <thead>
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

<form>
    <label for="name">Name:</label>
    <input type="text" name="name" id="name"/>

    <label for="email">E-mail:</label>
    <input type="text" name="email" id="email"/>

    <label for="city">City:</label>
    <input type="text" name="city" id="city"/>

    <label for="phone">Phone:</label>
    <input type="text" name="phone" id="phone"/>

    <button type="button" id="submitBtn">Create new row</button>
</form>

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