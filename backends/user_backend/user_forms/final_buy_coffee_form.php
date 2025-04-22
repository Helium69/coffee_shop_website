
<table>
    <tr>
        <td> Small </td>
        <td> Medium </td>
        <td> Large </td>
    </tr>

    <tr>
        <td> <?php echo $coffee_list[$_SESSION["selected_coffee"]]["SMALL"] ?> </td>
        <td> <?php echo $coffee_list[$_SESSION["selected_coffee"]]["MEDIUM"] ?> </td>
        <td> <?php echo $coffee_list[$_SESSION["selected_coffee"]]["LARGE"] ?> </td>
    </tr>
</table>

<div class="form">

    <form action="<?php $_SERVER["PHP_SELF"]?>" method="POST">
        <input type="hidden" name="buy_coffee">
        <input type="hidden" name="select_coffee">
        <select name="size">
            <option value="SMALL"> Small </option>
            <option value="MEDIUM"> Medium </option>
            <option value="LARGE"> Large </option>
        </select>

        <input type="number" name="quantity" min="1" max="10">
        <input type="submit" name="submit_order">
    </form>
</div>