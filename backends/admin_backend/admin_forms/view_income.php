<h2 class="title"> <strong> Transaction History </strong> </h2>
<table>
    <tr>
        <td> <b> Name </b> </td>
        <td> <b> Payment </b> </td>
        <td> <b> Date of Payment </b> </td>
    </tr>

    <?php 

        foreach($transaction_list as $transaction){
            echo "
            <tr>
                <td> $transaction[name] </td>
                <td> $transaction[payment] </td>
                <td> $transaction[transaction_date] </td>
            </tr>";
        }
        
    ?>
    
</table>