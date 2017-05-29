


<div class="container">

	<form class="well span8" role="form">
		<div class="row">
			<div class="col-md-3 ">

				<div class="form-group">
					<label>First Name</label> <input class="form-control"
						placeholder="Your First Name" type="text">
				</div>

				<div class="form-group">
					<label>Last Name</label> <input class="form-control"
						placeholder="Your Last Name" type="text">
				</div>

				<div class="form-group">
					<label>Email Address</label> <input class="form-control"
						placeholder="Your email address" type="text">
				</div>

				<div class="form-group">
					<label>Subject</label> <select class="form-control" id="subject"
						name="subject">
						<option selected value="na">Choose One:</option>

						<option value="service">General Customer Service</option>

						<option value="suggestions">Suggestions</option>

						<option value="product">Product Support</option>
					</select>
				</div>



			</div>

			<div class="col-md-8">
				<label>Message</label>
				<textarea class="form-control" rows="10"></textarea>

				<button class="btn btn-primary pull-right voffset3" type="submit">Send</button>
			</div>


		</div>
		<!-- STAr -->
		<div class="container">
			<div class="row">
				<h2>Vos commentaires nous aident pour améliorer le travail</h2>
				<h4>Vous pouvez donner votre avis sur le utilisateur</h4>
			</div>
			<div class="row lead">
				<div id="stars" class="starrr"></div>
				Vous avez donné une note de <span id="count">0</span> star(s)
			</div>

			<div class="row lead">
				<p>Vous pouvez également donner votre avis sur le jeux</p>
				<div id="stars-existing" class="starrr" data-rating='4'></div>
				Vous avez donné une note de <span id="count-existing">4</span>
				star(s)
			</div>
		</div>
	</form>
</div>

<br />
<br />
<br />