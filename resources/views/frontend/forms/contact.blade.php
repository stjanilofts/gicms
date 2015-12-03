<div id="contact-form">
	<form v-on:submit.prevent="onSubmit" v-if="!isSubmitted">
		<div class="form-row">
			<input id="fyrirspurn_nafn"
				   @focus="clearError"
				   :class="{'form-error': errors.nafn.length}"
				   type="text"
				   class=""
				   :disabled="isSubmitting"
				   name="nafn"
				   v-model="fyrirspurn.nafn"
			   	   placeholder="Nafn" />
		</div>

		<div class="form-row">
			<input id="fyrirspurn_netfang"
				   @focus="clearError"
				   :class="{'form-error': errors.netfang.length}"
				   type="text"
				   class=""
				   :disabled="isSubmitting"
				   name="netfang"
				   v-model="fyrirspurn.netfang"
			   	   placeholder="Netfang" />
		</div>

		<div class="form-row">
			<input id="fyrirspurn_simi"
				   @focus="clearError"
				   :class="{'form-error': errors.simi.length}"
				   type="text"
				   class=""
				   :disabled="isSubmitting"
				   name="simi"
				   v-model="fyrirspurn.simi"
			   	   placeholder="Sími" />
		</div>

		<div class="form-row">
			<input id="fyrirspurn_titill"
				   @focus="clearError"
				   :class="{'form-error': errors.titill.length}"
				   type="text"
				   class=""
				   :disabled="isSubmitting"
				   name="titill"
				   v-model="fyrirspurn.titill"
			   	   placeholder="Titill" />
		</div>

		<div class="form-row fullwidth">
			<textarea id="fyrirspurn_skilabod"
					  @focus="clearError"
					  :class="{'form-error': errors.skilabod.length}"
					  rows="6"
					  class=""
					  :disabled="isSubmitting"
					  name="skilabod"
				   	  v-model="fyrirspurn.skilabod"
			   	   	  placeholder="Skilaboðin hér..."></textarea>
		</div>

		<div class="clearfix"></div>

		<div class="form-row fullwidth">
			<button class="takki larger"
					:disabled="isSubmitting || errors.length">
				<span v-if="isSubmitting">
					Er að senda<span style="width: 20px; display: inline-block; text-align: left;">@{{ dots }}</span>
				</span>

				<span v-if="!isSubmitting">
					Senda skilaboð
				</span>
			</button>
		</div>
	</form>

	<div v-if="isSubmitted">
		<h3>Takk fyrir!</h3>
		<p>Við munum fara yfir skilaboðin þín og vera í bandi.</p>
	</div>
</div>

<script>
var contact_form = new Vue({
	el: '#contact-form',
	
	data: {
		dots: '',
		timer: false,
		interval: false,
		isSubmitting: false,
		isSubmitted: false,

		fyrirspurn: {
			nafn: '',
			netfang: '',
			simi: '',
			titill: '',
			skilabod: ''
		},

		errors: {
			nafn: '',
			netfang: '',
			simi: '',
			titill: '',
			skilabod: ''
		},

		button_text: 'Skrá mig'
	},

	ready: function() {
		this.isSubmitting = false;
		this.isSubmitted = false;
	},


    methods: {
    	clearError: function(e) {
    		var $name = e.target.getAttribute('name');
    		this.errors[$name] = '';
    	},

    	hasError: function(name) {
    		return (this.errors.hasOwnProperty(name) && this.errors[name].length);
    	},

    	onSubmit: function(e) {
    		var self = this;

    		clearTimeout(self.timer);
    		clearInterval(self.interval);

    		self.isSubmitted = false;
    		self.isSubmitting = true;

    		self.errors = [];

    		self.interval = setInterval(function() {
    			self.dots = self.dots + '.';

    			if(self.dots.length == 4) {
    				self.dots = '';
    			}
    		}, 250);

    		self.timer = setTimeout(function() {
    			self.$http.post('/hafa-samband', self.fyrirspurn, function(data, status, request) {
    				//console.log('done', data, status, request);
	    			self.isSubmitted = true;
	    			self.isSubmitting = false;
	    		}).error(function(data, status, request) {
	    			//console.log('not done', data, status, request);
	    			self.$set('errors', data);
	    			self.isSubmitting = false;
	    		});
	    	}, 1000);
    	}
    }
});
</script>