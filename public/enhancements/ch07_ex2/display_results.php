<?php include('views/header.php') ?>
    <main>
        <h1>Future Value Calculator</h1>

        <label>Investment Amount:</label>
        <span><?php echo $investment_f; ?></span><br>

        <label>Yearly Interest Rate:</label>
        <span><?php echo $yearly_rate_f; ?></span><br>

        <label>Number of Years:</label>
        <span><?php echo $years; ?></span><br>

        <label>Future Value:</label>
        <span><?php echo $future_value_f; ?></span><br>

        <label>Compound Monthly:</label>
        <span><?php echo $monthlyStr ?></span>

        <form action="." method="post">
          <div>
            <input type="hidden" name="action" value="calculationForm"/>
          </div>

          <div id="buttons">
              <label>&nbsp;</label>
              <input type="submit" value="Done"/><br>
          </div>
        </form>
    </main>
<?php include('views/footer.php') ?>
