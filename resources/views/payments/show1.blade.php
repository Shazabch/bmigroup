@extends('layouts.main1')
@section('content')
@section('title')
<nav class="navbar navbar-main navbar-expand-lg px-0 shadow-none border-radius-xl">
  <div class="container-fluid ">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Admin</a></li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Payments</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Single Payment</li>
      </ol>
    </nav>
  </div>
</nav>
@endsection
<div id="app">
  <div class="row mt-2 p-2">
    <div class="col m-2">
      <div class="card mt-2">
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="font-weight-bolder mb-0">Payment Details</h5>
            </div>

          </div>
          <br>
          <div class="row">
            <div class="col-md-6">
              <b>Customer No.</b>
              <p >{{$ad->customer_no}}</p>
            </div>
            <div class="col-md-6">
              <b>Company Name</b>
              <p >{{$ad->name}}</p>
            </div>

            <div class="col-md-6">
              <b>Amount</b>
              <p v-text="toCurrency(payment.amount)"></p>
            </div>
            <div class="col-md-6">
              <b>Outstanding</b>
              <p v-text="toCurrency(payment.outstanding)"></p>
            </div>
            <div class="col-md-6">
              <b>Status</b>
              <p><span class="badge badge-sm" :class="{
                'badge-secondary': payment.status == 0,
                'badge-success': payment.status == 1
              }" v-text="payment.status == 0 ? 'PENDING ACKNOWLEDGEMENT' : 'ACKNOWLEDGED'"></span></p>
            </div>

            <div class="col-md-6">
              <b>Proof Document</b>
              <p><a style="color:#009fe3;" href="{{route('payments.download',$payment->id)}}" v-text="payment.proof"></a></p>
            </div>
            <div class="col-md-6">
              <b>Payment Date</b>
              <p v-text="payment.payment_date"></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row mt-2 p-2">
    <div class="col m-2">
      <div class="card mt-2">
        <div class="card-body">
          <div class="row">
            <div class="col">
              <h5 class="font-weight-bolder mb-0">Invoices Involved</h5>
            </div>
            <div class="table-responsive">
              <div class="dataTable-wrapper dataTable-loading no-footer sortable fixed-height fixed-columns">
                <div class="dataTable-top">

                  <table class="table align-items-center mb-0">

                    <thead class="mt-2">
                      <tr>
                        <!--<th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Customer Name</th>-->
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Actions</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Due Date</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center">Invoice No.</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Do No.</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Amount (MYR)</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Outstanding (MYR)</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Invoice Doc</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Do Doc</th>
                        <!--<th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created at</th>-->
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="invoice in invoices" :key="invoice.id">
                        <td>
                          <p class="text-xs text-secondary mb-0 text-center">
                            <i class="fa fa-usd text-success" title="Add Payment" style="cursor: pointer;" aria-hidden="true" @click="selectInvoice(invoice)"></i>
                          </p>
                        </td>
                        <td>
                          <p class="text-xs text-secondary mb-0 text-center" v-text="invoice.date"></p>
                        </td>
                        <td>
                          <p class="text-xs text-secondary mb-0 text-center" v-text="invoice.invoiceId"></p>
                        </td>
                        <td>
                          <p class="text-xs text-secondary mb-0 text-center" v-text="invoice.do_no"></p>
                        </td>
                        <td>
                          <p class="text-xs text-secondary mb-0 text-center" v-text="toCurrency(invoice.amount)"></p>
                        </td>
                        <td>
                          <p class="text-xs text-secondary mb-0 text-center" v-text="toCurrency(invoice.outstanding)"></p>
                        </td>
                        <td>
                          <p class="text-xs text-secondary mb-0 text-center"
                          v-text="invoice.invoice_doc"></p>
                        </td>
                        <td>
                        </td>

                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div v-if="showModal" class="d-flex align-items-center justify-content-center position-fixed" style="inset: 0; background-color: rgba(0, 0, 0, .4);">
    <div class="bg-white w-75 p-3 rounded" style="max-width: 500px">
      <div>
        <form @submit.prevent="makePayment">
          <div class="mb-3">
            <label for="payment-amount" class="form-label">Payment Amount</label>
            <p v-text="c" ref="myText" ></p>
            <input type="number" step="0.01" class="form-control" id="payment-amount" placeholder="10000" v-model="paymentAmount" @:focus="selectInput" @keyup="scenarios">
          </div>
          <button type="submit" :disabled="isDisabled" class="btn btn-secondary btn-sm">Pay</button>
        </form>
      </div>
      <footerc class="float-end">
        <button class="btn bg-gradient-info btn-sm" @click="showModal = !showModal">Close</button>
        </footer>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.2.45/vue.global.prod.min.js" integrity="sha512-3CesFAr6COyDB22AiVG2erk2moD1FeL3VMx6UezptTW3qmYdcQhfv6yDGmH4ICNTxd0Rs2AbMQ0Q5lG7J/8n3Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  const data = <?php echo json_encode(['payment' => $payment, 'invoices' => $invoices]); ?>

  const app = {
    data() {
      return {
        payment: data.payment,
        invoices: data.invoices,
        showModal: false,
        paymentAmount: 0,
        selectedInvoice: null,
        isDisabled:false,
        c:'',
      }
    },
    methods: {
     
          makePayment() {
          axios.post('/payment/add-new-payment',{
              selectInvoice : this.selectedInvoice.id,
              paymentAmount : this.paymentAmount,
            })
            .then(response =>{
                this.payment.outstanding = response.data.paymentAmount;
                const invoice = this.invoices.find(invoice => invoice.id === this.selectedInvoice.id);
                invoice.outstanding = response.data.invoiceAmount;
                this.showModal = false;
            })
            .catch(error => {
                console.error(error);
            });
            },
            selectInput(e) {
                e.target.select();
            },
            toCurrency(value) {
              return new Intl.NumberFormat('ur-PK', { style: 'currency', currency: 'MYR' }).format(value);
            },
            scenarios(e) {
                if(this.paymentAmount > this.payment.outstanding){
                  this.c = 'The amount entered exceed the payment outstanding !';
                  this.$refs.myText.style.color = 'red';
                  this.$refs.myText.style.fontSize = '13px';
                  this.$refs.myText.style.marginLeft = '5px';
                  this.isDisabled = true ;
                }
                else if(this.paymentAmount < 0 ){
                  this.$refs.myText.style.color = 'red';
                  this.$refs.myText.style.fontSize = '13px';
                  this.$refs.myText.style.marginLeft = '5px';
                  this.c = 'The amount is incorrect !';
                  this.isDisabled = true ;
                }
                else if(this.paymentAmount > this.selectedInvoice.outstanding){
                  this.$refs.myText.style.color = 'red';
                  this.$refs.myText.style.fontSize = '13px';
                  this.$refs.myText.style.marginLeft = '5px';
                  this.c = 'The amount enetered exceed the invoice outstanding!';
                  this.isDisabled = true ;
                }
                else{
                  this.c = '';
                  this.isDisabled = false ;
                }
            },
            selectInvoice(invoice) {
                this.selectedInvoice = {
                ...invoice
                };
                this.showModal = true;
                console.log(this.formattedDate);
            }
            }
        };

  Vue.createApp(app).mount('#app');
</script>
@endsection