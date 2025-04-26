<h3 class="title"> <strong> All Current Signed Up Users</strong></h3>
<table>
    <tr>
        <td> <b> ID </b> </td>
        <td> <b> NAME </b> </td>
        <td> <b> SEX </b> </td>
        <td> <b> USERNAME </b> </td>
        <td> <b> CASHED IN BALANCE </b> </td>
        <td> <b> DEBT BALANCE </b> </td>
        <td> <b> TOTAL BALANCE </b> </td>
        <td> <b> ACCOUNT STATUS </b> </td>
        <td> <b> DATE & TIME JOINED </b> </td>
    </tr>

    
<?php foreach($userlist as $user){echo "
    <tr>
        <td> $user[id] </td>
        <td> $user[name] </td>
        <td> $user[sex] </td>
        <td> $user[username] </td>
        <td> $user[cashed_in] </td>
        <td> $user[debt] </td>
        <td> $user[total_balance] </td>
        <td> $user[banned] </td>
        <td> $user[date_joined] </td>
    </tr> ";
}?>
</table>