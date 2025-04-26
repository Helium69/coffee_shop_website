<h2 class="title"> <strong> Add-Ons Menu </strong></h2>
<table> 
    <tr> 
        <td> <strong> Add-ons </strong> </td>
        <td> <strong> Price </strong> </td>
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