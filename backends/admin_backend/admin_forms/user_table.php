<h3> <strong> All Current Signed Up Users</strong></h3>
<table>
    <tr>
        <td> ID </td>
        <td> NAME </td>
        <td> SEX </td>
        <td> USERNAME </td>
        <td> CASHED IN BALANCE </td>
        <td> DEBT BALANCE </td>
        <td> TOTAL BALANCE </td>
        <td> ACCOUNT STATUS </td>
        <td> DATE JOINED </td>
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