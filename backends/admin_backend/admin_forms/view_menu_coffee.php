<h2 class="title"> <strong> Coffee Menu </strong></h2>
<table>
    <tr>
        <td> <strong> Coffee </strong> </td>
        <td> <strong> Size </strong></td>
        <td> <strong> Price </strong> </td>
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