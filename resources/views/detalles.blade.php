@extends('plantilla')

@section('pagecontent')

	<div class="container-bootstrap">
		<div class="topclear">
			&nbsp;
		</div>
		<div class="topclear">
			&nbsp;
		</div>
		@include('content_holders.notificaciones')
<div class="stepwizard">
    <div class="stepwizard-row setup-panel">
        <div class="stepwizard-step">
            <a href="#VerifyEmail-step" type="button" class="btn btn-primary btn-circle" disabled="disabled" id="step1">
                <span class="fa fa-id-card-o"></span>
            </a>
            <p>Detalles personales</p>
        </div>
        <div class="stepwizard-step">
            <a href="#ProfileSetup-step" type="button" class="btn btn-primary btn-circle" id="ProfileSetup-step-2">
                <span class="fa fa-address-book"></span>
            </a>
            <p>Direcciones</p>
        </div>
        <div class="stepwizard-step">
            <a href="#Security-Setup-step" type="button"  class="btn btn-success-2 btn-circle"  disabled="disabled" id="Security-Setup-step-3">
                <span class="fa fa-credit-card-alt"></span>
            </a>
            <p>Metódos de pago</p>
        </div>
    </div>
</div>

    <div class="row setup-content" id="VerifyEmail-step">
        <div class="col-xs-12">
            <div class="col-md-12">
                 <br/>
                <div class="form-horizontal">

                </div>
                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Setup Profile</button>
            </div>
        </div>
    </div>
    <div class="row setup-content" id="ProfileSetup-step">
        <div class="col-xs-12">
            <div class="col-md-12">
                 <br/>
                <div class="form-horizontal">
									<form action="{{ url('/completar-registro') }}" method="post">

												<legend>Ingresa tus detalles personales</legend>
												<br/>
												<div class="form-group">
													<label class="col-sm-3 control-label" for="card-holder-name">Foto de perfil</label>
													<div class="col-sm-9">
														<input class="form-control" type="text" value="{{ old('photo') }}" name="photo" required>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label" for="card-number">Fecha de naciemiento</label>
													<div class="col-sm-9">
														<div class="input-group">
														<input class="form-control datepicker" type="text" value="{{ old('dob') }}" name="dob" required><span class="input-group-addon"><i class="fa fa-calendar" aria-hidden="true"></i></span>
													</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label" for="card-number">Teléfono</label>
													<div class="col-sm-9">
													 <input class="form-control" type="tel" value="{{ old('tel')}}" placeholder="5555555555" name="tel" required>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label" for="card-number">Intereses</label>
													<div class="col-sm-9">
													 <input class="form-control" type="text" value="{{ old('intereses')}}" placeholder="Yoga, spinning, zumba..." name="intereses">
													</div>
												</div>
												{!! csrf_field() !!}
												<input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
												<div class="form-group">
													<div class="col-sm-12">
														<input class="btn btnCheckout pull-right" type="submit" value="Guardar">
													</div>
												</div>


									</form>
                </div>
                <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Setup Profile</button>
            </div>
        </div>
    </div>
    <div class="row setup-content" id="Security-Setup-step">
        <div class="col-xs-12">
            <div class="col-md-12">
                <b>Thanks you  <stong>Muneeb Ashraf</stong></b>
                <p>We are almost done, please enter the following information so we can recover your account in case you ever forget your password.</p>

                <div class="form-horizontal">
                    <form  role="form">
                        <fieldset>
                          <br/>
                          <div class="form-group">
                            <label class="col-sm-3 control-label" for="card-holder-name">Security Question 1:</label>
                            <div class="col-sm-9">
                              <select required="required" class="form-control" >
                                  <option value="0">Select Country</option>
                                 <option value="pakistan">Pakistan</option>
                                 <option value="usa">USA</option>
                             </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-3 control-label" for="card-number">Your Answer:</label>
                            <div class="col-sm-9">
                             <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Name" />
                            </div>
                          </div>
                          <br/>
                          <hr>
                          <br/>
                          <div class="form-group">
                            <label class="col-sm-3 control-label" for="card-holder-name">Security Question 2:</label>
                            <div class="col-sm-9">
                              <select required="required" class="form-control" >
                                  <option value="0">Select Country</option>
                                 <option value="pakistan">Pakistan</option>
                                 <option value="usa">USA</option>
                             </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-3 control-label" for="card-number">Your Answer:</label>
                            <div class="col-sm-9">
                             <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Name" />
                            </div>
                          </div>
                           <br/>
                          <hr>
                          <br/>
                          <div class="form-group">
                            <label class="col-sm-3 control-label" for="card-holder-name">Security Question 3:</label>
                            <div class="col-sm-9">
                              <select required="required" class="form-control" >
                                  <option value="0">Select Country</option>
                                 <option value="pakistan">Pakistan</option>
                                 <option value="usa">USA</option>
                             </select>
                            </div>
                          </div>
                          <div class="form-group">
                            <label class="col-sm-3 control-label" for="card-number">Your Answer:</label>
                            <div class="col-sm-9">
                             <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Name" />
                            </div>
                          </div>
                           <br/>
                          <hr>
                          <br/>
                          <div class="form-group">
                            <label class="col-sm-3 control-label" for="card-number">Recover cellphone Number:</label>
                            <div class="col-sm-9">
                             <input maxlength="100" type="text" required="required" class="form-control" placeholder="Enter Cellphone Number" />
                             <p>Optional: We may send you a recovery code on this phone number if you are ever unable to lgoin to your account.</p>
                            </div>

                          </div>
                        </fieldset>
                    </form>
                </div>
                <!--h3> You are all set!</h3>
                <p>Welcome to MetroPago. We are glade to have you here.</p-->
                <button class="btn btn-primary btn-lg pull-right nextBtn" type="submit">Complete Registration</button>
            </div>
        </div>
    </div>

</div>


<div class="topclear">
	&nbsp;
</div>
<div class="topclear">
	&nbsp;
</div>
  @endsection
