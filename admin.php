<?php
$data = json_decode(file_get_contents("transactions.json"), true);
?>

<h2>All Transactions</h2>
<table border="1" cellpadding="10">
<tr>
<th>Order ID</th>
<th>Payment ID</th>
<th>Amount</th>
<th>Status</th>
<th>Date</th>
</tr>

<?php foreach($data as $txn){ ?>
<tr>
<td><?php echo $txn['order_id']; ?></td>
<td><?php echo $txn['payment_id']; ?></td>
<td><?php echo $txn['amount']; ?></td>
<td><?php echo $txn['status']; ?></td>
<td><?php echo $txn['created_at']; ?></td>
</tr>
<?php } ?>
</table>