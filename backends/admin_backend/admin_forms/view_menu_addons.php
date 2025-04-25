<table> 
    <tr> 
        <td> Add-ons </td>
        <td> Price </td>
    </tr>

    <?php 
        foreach($addons_list as $addons => $price){
            echo "
                <tr> 
                    <td> $addons </td>
                    <td> $price </td>
                </tr>
            ";
        }
    ?>
</table>