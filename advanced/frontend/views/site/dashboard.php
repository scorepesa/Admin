<?php
/* @var $this yii\web\View */

$this->title = 'Scorepesa : Adminstration';
?>

<body>

	<div class="wrapper">

	    	    <div class="main-panel">
			<nav class="navbar navbar-transparent navbar-absolute">
				<div class="container-fluid">
					<div class="navbar-header">
					    <a class="navbar-brand" href="#">Scorepesa Dashboard</a>
					</div>
				</div>
			</nav>

			<div class="content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="card card-stats">
								<div class="card-header" data-background-color="orange">
									<i class="material-icons">content_copy</i>
								</div>
								<div class="card-content">
									<p class="category">Total Bets Today</p>
									<h3 class="title"><?php echo $model->totalStats[0]['bets']; ?> <small></small></h3>
									<h3 class="title">KSH <?php echo number_format($model->totalStats[0]['stake'], 2, '.', ','); ?> <small></small></h3>
								</div>
								<!--<div class="card-footer">
									<div class="stats">
										<i class="material-icons text-danger">warning</i> <a href="#pablo">Get More Space...</a>
									</div>
								</div> -->
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="card card-stats">
								<div class="card-header" data-background-color="green">
									<i class="material-icons">store</i>
								</div>
								<div class="card-content">
									<p class="category">Deposits</p>
									<h3 class="title"><?php echo $model->todayDeposits()[0]['count']; ?></h3>
									<h3 class="title">KSH <?php echo number_format($model->todayDeposits()[0]['deposit'], 2, '.', ','); ?> <small></small></h3>
								</div>
								<!--<div class="card-footer">
									<div class="stats">
										<i class="material-icons">date_range</i> Last 24 Hours
									</div>
								</div> -->
							</div>
						</div>
						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="card card-stats">
								<div class="card-header" data-background-color="red">
									<i class="material-icons">info_outline</i>
								</div>
								<div class="card-content">
									<p class="category">Won</p>
									<h3 class="title"><?php echo $model->totalStats[0]['won']; ?></h3>
									<h3 class="title">KSH <?php echo number_format($model->totalStats[0]['won_amount'], 2, '.', ','); ?> <small></small></h3>
								</div>
								<!--<div class="card-footer">
									<div class="stats">
										<i class="material-icons">local_offer</i> Tracked from Github
									</div>
								</div> -->
							</div>
						</div>

						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="card card-stats">
								<div class="card-header" data-background-color="blue">
									<i class="fa fa-twitter"></i>
								</div>
								<div class="card-content">
									<p class="category">Lost</p>
									<h3 class="title"><?php echo $model->totalStats[0]['lost']; ?></h3>
									<h3 class="title">KSH <?php echo number_format($model->totalStats[0]['lost_stake'], 2, '.', ','); ?> <small></small></h3>
								</div>
								<!--<div class="card-footer">
									<div class="stats">
										<i class="material-icons">update</i> Just Updated
									</div>
								</div> -->
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-md-4">
							<div class="card">
								<div class="card-header card-chart" data-background-color="green">
									<div class="ct-chart" id="dailySalesChart"></div>
								</div>
								<div class="card-content">
									<h4 class="title">Bet Stats</h4>
									<!--<p class="category"><span class="text-success"><i class="fa fa-long-arrow-up"></i> 55%  </span> increase in today sales.</p> -->
								</div>
								<!--<div class="card-footer">
									<div class="stats">
										<i class="material-icons">access_time</i> updated 4 minutes ago
									</div>
								</div> -->
							</div>
						</div>

						<div class="col-md-4">
							<div class="card">
								<div class="card-header card-chart" data-background-color="orange">
									<div class="ct-chart" id="winnings"></div>
								</div>
								<div class="card-content">
									<h4 class="title">Winnings in '000</h4>
								<!--	<p class="category">Last Campaign Performance</p> -->
								</div>
								<!--<div class="card-footer">
									<div class="stats">
										<i class="material-icons">access_time</i> campaign sent 2 days ago
									</div>
								</div> -->

							</div>
						</div>

						<div class="col-md-4">
							<div class="card">
								<div class="card-header card-chart" data-background-color="red">
									<div class="ct-chart" id="deposits"></div>
								</div>
								<div class="card-content">
									<h4 class="title">Collections in '000</h4>
									<!-- <p class="category">Last Campaign Performance</p> -->
								</div>
								<!-- <div class="card-footer">
									<div class="stats">
										<i class="material-icons">access_time</i> campaign sent 2 days ago
									</div>
								</div> -->
							</div>
						</div>
					</div>

					</div>
				</div>
			</div>

		</div>
	</div>
<?php $this->registerJsFile('@web/js/scorepesa.js', ['depends' => \ramosisw\CImaterial\web\MaterialAsset::className()]); ?>
