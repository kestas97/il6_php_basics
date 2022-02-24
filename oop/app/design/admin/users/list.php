<?php ?>
<div class="wrapper">

    <form action="<?= $this->url('admin/changeuserstatus')?>" method="POST">
<table>
    <tr>

        <th>#</th>
        <th>Id</th>
        <th>Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>City</th>
        <th>Status</th>
        <th>Active</th>
    </tr>
<?php foreach ($this->data['users'] as $user): ?>
<tr>
    <td><input name="collection[]" value="<?= $user->getId() ?>" type="checkbox"></td>
    <td><?= $user->getId();?></td>
    <td><?= $user->getName();?></td>
    <td><?= $user->getLastName();?></td>
    <td><?= $user->getEmail();?></td>
    <td><?= $user->getPhone();?></td>
    <td><?= $user->getCityId();?></td>
    <td><?= $user->getRoleId();?></td>
    <td><?= $user->isActive();?></td>

    <td>
        <a href="<?= $this->url('admin/useredit', $user->getId()) ?>">Edit</a>
    </td>
</tr>
<?php endforeach;  ?>
</table>
        <select name="action">
            <option value="1"> Aktivuoti </option>
            <option value="0"> Isaktyvuoti </option>
        </select>
        <input type="submit" value="submit">


    </form>
</div>
