@extends('layouts.app')

@section('content')
            {{--  <form action="{{route('tasks.select_proposal.store')}}" method="POST">
                @csrf
                <input type="hidden" name="task_id" value="{{$task_id}}">
                <input type="hidden" name="prop_id" value="{{$prop_id}}">
                <button class="btn btn-success">Внести предоплату</button>
            </form>  --}}
<div id="titlebar" class="gradient">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Оплата</h2>
                <!-- Breadcrumbs -->
                <nav id="breadcrumbs" class="dark">
                    <ul>
                        <li><a href="#">Главная</a></li>
                        <li><a href="#">Оплата</a></li>
                        <li>Подтверждение</li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="container">
	<div class="row">
		<div class="col-xl-8 col-lg-8 content-right-offset">
			<!-- Hedline -->
			<h3>Метод оплаты</h3>

			<!-- Payment Methods Accordion -->
			<div class="payment margin-top-30">

				<div class="payment-tab payment-tab-active">
					<div class="payment-tab-trigger">
						<input checked id="paypal" name="cardType" type="radio" value="paypal">
						<label for="paypal">PayPal</label>
						<img class="payment-logo paypal" src="https://i.imgur.com/ApBxkXU.png" alt="">
					</div>

					<div class="payment-tab-content">
						<p>Вы будете перенаправлены на PayPal для завершения платежа.</p>
					</div>
				</div>


				<div class="payment-tab">
					<div class="payment-tab-trigger">
						<input type="radio" name="cardType" id="creditCart" value="creditCard">
						<label for="creditCart">Кредитная / Дебетовая карта</label>
						<img class="payment-logo" src="https://i.imgur.com/IHEKLgm.png" alt="">
					</div>

					<div class="payment-tab-content">
						<div class="row payment-form-row">

							<div class="col-md-6">
								<div class="card-label">
									<input id="nameOnCard" name="nameOnCard" required type="text" placeholder="Cardholder Name">
								</div>
							</div>

							<div class="col-md-6">
								<div class="card-label">
									<input id="cardNumber" name="cardNumber" placeholder="Credit Card Number" required type="text">
								</div>
							</div>

							<div class="col-md-4">
								<div class="card-label">
									<input id="expiryDate" placeholder="Expiry Month" required type="text">
								</div>
							</div>

							<div class="col-md-4">
								<div class="card-label">
									<label for="expiryDate">Expiry Year</label>
									<input id="expirynDate" placeholder="Expiry Year" required type="text">
								</div>
							</div>

							<div class="col-md-4">
								<div class="card-label">
									<input id="cvv" required type="text" placeholder="CVV">
								</div>
							</div>

						</div>
					</div>
				</div>

			</div>
			<!-- Payment Methods Accordion / End -->
        
            <form action="{{route('tasks.select_proposal.store')}}" method="POST">
                @csrf
                <input type="hidden" name="task_id" value="{{$task_id}}">
                <input type="hidden" name="prop_id" value="{{$prop_id}}">
                <button type="submit" class="button big ripple-effect margin-top-40 margin-bottom-65">Оплатить</button>
            </form>
		</div>


		<!-- Summary -->
		<div class="col-xl-4 col-lg-4 margin-top-0 margin-bottom-60">
			
			<!-- Summary -->
			<div class="boxed-widget summary margin-top-0">
				<div class="boxed-widget-headline">
					<h3>Итого - "{{ $taskTitle }}"</h3>
				</div>
				<div class="boxed-widget-inner">
					<ul>
						<li>Стоимость предложения <span>₽@money($proposalPrice)</span></li>
						<li>Комиссия (10%) <span>₽@money($proposalPrice*0.1)</span></li>
						<li class="total-costs">Итого <span>₽@money($proposalPrice + $proposalPrice*0.1)</span></li>
					</ul>
				</div>
			</div>
			<!-- Summary / End -->

			<!-- Checkbox -->
			<div class="checkbox margin-top-30">
				<input type="checkbox" id="two-step">
				<label for="two-step"><span class="checkbox-icon"></span>  Я согласен с <a href="#">Правилами сервиса</a></label>
			</div>
		</div>

	</div>
</div>    
@endsection
