<table>
    <tr>
        <td> Name </td>
        <td> Payment </td>
        <td> Date of Payemnt </td>
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