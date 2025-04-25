<table>
    <tr>
        <td> Coffee </td>
        <td> Size </td>
        <td> Price </td>
    </tr>

    <?php
        foreach($coffee_list as $coffee_name => $coffee_sizes){
            foreach($coffee_sizes as $coffee_size => $coffee_price){
                echo
                "
                    <tr>
                        <td> $coffee_name </td>
                        <td> $coffee_size </td>
                        <td> $coffee_price </td>
                    </tr>
                ";
            }
        }
    ?>
</table>