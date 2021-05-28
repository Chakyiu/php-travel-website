<!-- Bonus Modal -->
<div id="bonusModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title">Bonus Point</h3>
      </div>
      <div class="modal-body">
        <h3>Your bonus point: <?php echo $bonus; ?></h3><br>
        <h4 class="text-center">Go see what ticket can redeem:<br><button type="button" class="btn btn-success btn-block" onclick="window.location='customer_bonus_free_ticket.php'">Free Ticket</button></h4>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- END Bonus Modal -->