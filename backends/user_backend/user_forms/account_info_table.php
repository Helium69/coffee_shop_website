<table>
    <tr>
        <td> Name <td>
        <td> Deposit </td>
        <td> Debt </td>
        <td> Total Balance </td>
    </tr>

    <tr>
        <td> <?php echo $_SESSION["user"]["name"] ?>  <td>
        <td> <?php echo $_SESSION["user"]["cashed_in"] ?></td>
        <td> <?php echo $_SESSION["user"]["debt"] ?> </td>
        <td> <?php echo $_SESSION["user"]["total_balance"] ?> </td>
    </tr>
</table>