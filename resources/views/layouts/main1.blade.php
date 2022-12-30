
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="{{asset('soft-theme/assets/img/apple-icon.png')}}">
  <link rel="icon" type="image/png" href="{{asset('soft-theme/assets/img/favicon.png')}}">
  <title>
    BMI Portal
  </title>
  <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link href="{{asset('soft-theme/assets/css/nucleo-icons.css')}}" rel="stylesheet" />
  <link href="{{asset('soft-theme/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{asset('soft-theme/assets/css/nucleo-svg.css')}}" rel="stylesheet" />
  <link id="pagestyle" href="{{asset('soft-theme/assets/css/soft-ui-dashboard.css?v=1.0.9')}}" rel="stylesheet" />
  <link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  @livewireStyles
</head>
<style>
  .navbar-vertical .navbar-nav>.nav-item .nav-link.active .icon {
    background-image: linear-gradient(310deg, #2152ff 0%, #21d4fd 100%) !important;
  }
</style>

<body class="g-sidenav-show bg-gray-100">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 bg-white" id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/soft-ui-dashboard/pages/dashboard.html " target="_blank">
                <img src="{{asset('images/BMI_Group_Logo.jpg')}}" class="navbar-brand-img h-200" alt="main_logo">
                <span class="ms-1 font-weight-bold">Admin Dashboard</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="" id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link {{(request()->segment(2)=='dashboard') ? 'active' : '' }}" href="{{route('admin.dashboard')}}">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>shop </title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF" fill-rule="nonzero">
                                <g transform="translate(1716.000000, 291.000000)">
                                <g transform="translate(0.000000, 148.000000)">
                                    <path class="color-background opacity-6" d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z"></path>
                                    <path class="color-background" d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z"></path>
                                </g>
                                </g>
                            </g>
                            </g>
                        </svg>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                  <!-- payments menu starts  -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#applicationsExamp" class="nav-link {{(request()->segment(1)=='payments') ? 'active' : '' }}" aria-controls="applicationsExamples" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <svg width="12px" height="12px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>settings</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF" fill-rule="nonzero">
                            <g transform="translate(1716.000000, 291.000000)">
                            <g transform="translate(304.000000, 151.000000)">
                            <polygon class="color-background" opacity="0.596981957" points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667"></polygon>
                            <path class="color-background" d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z" opacity="0.596981957"></path>
                            <path class="color-background" d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z"></path>
                            </g>
                            </g>
                            </g>
                            </g>
                            </svg>
                        </div>
                    <span class="nav-link-text ms-1">Payment Records</span>
                    </a>
                        <div class="{{(request()->segment(1)=='payments')  ? '' : 'collapse' }}" id="applicationsExamp" style="">
                            <ul class="nav ms-4 ps-3">
                                <li class="nav-item ">
                                    <a class="nav-link {{(request()->segment(1)=='payments') && (request()->segment(2)=='approved')  ? 'active' : '' }}" href="{{route('payments.approved')}}">
                                        
                                        <span class="sidenav-normal"> Paid Invoices </span>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link {{(request()->segment(1)=='payments') && (request()->segment(2)=='pending')  ? 'active' : '' }}" href="{{route('payments.pending')}}">
                                        
                                        <span class="sidenav-normal">Not Acknowledged</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                </li>
                <!-- payments menu ends  -->
                <!-- invoices menu starts  -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#applicationsExample" class="nav-link {{(request()->segment(1)=='invoices') ? 'active' : '' }} collapsed" aria-controls="applicationsExamples" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <svg width="12px" height="12px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>settings</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF" fill-rule="nonzero">
                            <g transform="translate(1716.000000, 291.000000)">
                            <g transform="translate(304.000000, 151.000000)">
                            <polygon class="color-background" opacity="0.596981957" points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667"></polygon>
                            <path class="color-background" d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z" opacity="0.596981957"></path>
                            <path class="color-background" d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z"></path>
                            </g>
                            </g>
                            </g>
                            </g>
                            </svg>
                        </div>
                    <span class="nav-link-text ms-1">{{__('labels.invoices')}}</span>
                    </a>
                        <div class=" {{(request()->segment(1)=='invoices') ? '' : 'collapse' }}" id="applicationsExample" style="">
                            <ul class="nav ms-4 ps-3">
                                <li class="nav-item ">
                                    <a class="nav-link {{(request()->segment(1)=='invoices') && (request()->segment(2)=='')  ? 'active' : '' }}" href="{{route('invoices.index')}}">
                                        <span class="sidenav-mini-icon">k</span>
                                        <span class="sidenav-normal">{{__('labels.view_invoice')}}</span>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link {{(request()->segment(1)=='invoices') && (request()->segment(2)=='create')  ? 'active' : '' }}" href="{{route('invoices.create')}}">
                                        
                                        <span class="sidenav-normal">{{__('labels.add_invocie')}}</span>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link {{(request()->segment(2)=='upload') ? 'active' : '' }}" href="{{route('invoices.upload')}}">
                                        
                                        <span class="sidenav-normal">{{__('labels.upload_invocie')}}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#a" class="nav-link {{(request()->segment(1)=='deliveryOrders') ? 'active' : '' }} collapsed" aria-controls="applicationsExamples" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <svg width="12px" height="12px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>settings</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF" fill-rule="nonzero">
                            <g transform="translate(1716.000000, 291.000000)">
                            <g transform="translate(304.000000, 151.000000)">
                            <polygon class="color-background" opacity="0.596981957" points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667"></polygon>
                            <path class="color-background" d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z" opacity="0.596981957"></path>
                            <path class="color-background" d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z"></path>
                            </g>
                            </g>
                            </g>
                            </g>
                            </svg>
                        </div>
                    <span class="nav-link-text ms-1">{{__('labels.delivery_order')}}</span>
                    </a>
                        <div class=" {{(request()->segment(1)=='deliveryOrders') ? '' : 'collapse' }}" id="a" style="">
                          <ul class="nav ms-4 ps-3">
                              <li class="nav-item ">
                                  <a class="nav-link {{(request()->segment(1)=='deliveryOrders') && (request()->segment(2)=='') ? 'active' : '' }}" href="{{route('deliveryOrders.index')}}">
                                      
                                      <span class="sidenav-normal">{{__('labels.view_delivery_order')}}</span>
                                  </a>
                              </li>
                                <li class="nav-item ">
                                    <a class="nav-link {{(request()->segment(1)=='deliveryOrders') && (request()->segment(2)=='create')  ? 'active' : '' }}" href="{{route('deliveryOrders.create')}}">
                                        <span class="sidenav-mini-icon">k</span>
                                        <span class="sidenav-normal">{{__('labels.add_delivery_order')}}</span>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link {{(request()->segment(1)=='deliveryOrders') && (request()->segment(2)=='upload')  ? 'active' : '' }}" href="{{route('deliveryOrder.upload')}}">
                                        <span class="sidenav-mini-icon">k</span>
                                        <span class="sidenav-normal">{{__('labels.upload_do')}}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#abc" class="nav-link {{(request()->segment(1)=='debitnotes') ? 'active' : '' }} collapsed" aria-controls="applicationsExamples" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <svg width="12px" height="12px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>settings</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF" fill-rule="nonzero">
                            <g transform="translate(1716.000000, 291.000000)">
                            <g transform="translate(304.000000, 151.000000)">
                            <polygon class="color-background" opacity="0.596981957" points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667"></polygon>
                            <path class="color-background" d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z" opacity="0.596981957"></path>
                            <path class="color-background" d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z"></path>
                            </g>
                            </g>
                            </g>
                            </g>
                            </svg>
                        </div>
                    <span class="nav-link-text ms-1">{{__('labels.dn')}}</span>
                    </a>
                        <div class=" {{(request()->segment(1)=='debitnotesOrders') ? '' : 'collapse' }}" id="abc" style="">
                          <ul class="nav ms-4 ps-3">
                              <li class="nav-item ">
                                  <a class="nav-link {{(request()->segment(1)=='debitnotes') && (request()->segment(2)=='') ? 'active' : '' }}" href="{{route('debitnotes.index')}}">
                                      
                                      <span class="sidenav-normal">{{__('labels.view_dn')}}</span>
                                  </a>
                              </li>
                                <li class="nav-item ">
                                    <a class="nav-link {{(request()->segment(1)=='debitnotes') && (request()->segment(2)=='create')  ? 'active' : '' }}" href="{{route('debitnotes.create')}}">
                                        <span class="sidenav-mini-icon">k</span>
                                        <span class="sidenav-normal">{{__('labels.add_dn')}}</span>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link {{(request()->segment(1)=='debitnote') && (request()->segment(2)=='upload')  ? 'active' : '' }}" href="{{route('debitnote.upload')}}">
                                        <span class="sidenav-mini-icon">k</span>
                                        <span class="sidenav-normal">{{__('labels.upload_dn')}}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#ac" class="nav-link {{(request()->segment(1)=='creditnotes') ? 'active' : '' }} collapsed" aria-controls="applicationsExamples" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <svg width="12px" height="12px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>settings</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF" fill-rule="nonzero">
                            <g transform="translate(1716.000000, 291.000000)">
                            <g transform="translate(304.000000, 151.000000)">
                            <polygon class="color-background" opacity="0.596981957" points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667"></polygon>
                            <path class="color-background" d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z" opacity="0.596981957"></path>
                            <path class="color-background" d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z"></path>
                            </g>
                            </g>
                            </g>
                            </g>
                            </svg>
                        </div>
                    <span class="nav-link-text ms-1">{{__('labels.cn')}}</span>
                    </a>
                        <div class=" {{(request()->segment(1)=='creditnotes') ? '' : 'collapse' }}" id="ac" style="">
                          <ul class="nav ms-4 ps-3">
                              <li class="nav-item ">
                                  <a class="nav-link {{(request()->segment(1)=='creditnotes') && (request()->segment(2)=='') ? 'active' : '' }}" href="{{route('creditnotes.index')}}">
                                      
                                      <span class="sidenav-normal">{{__('labels.view_cn')}}</span>
                                  </a>
                              </li>
                                <li class="nav-item ">
                                    <a class="nav-link {{(request()->segment(1)=='creditnotes') && (request()->segment(2)=='create')  ? 'active' : '' }}" href="{{route('creditnotes.create')}}">
                                        <span class="sidenav-mini-icon">k</span>
                                        <span class="sidenav-normal">{{__('labels.add_cn')}}</span>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link {{(request()->segment(1)=='creditnote') && (request()->segment(2)=='upload')  ? 'active' : '' }}" href="{{route('creditnote.upload')}}">
                                        <span class="sidenav-mini-icon">k</span>
                                        <span class="sidenav-normal">{{__('labels.upload_cn')}}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                </li>
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#appliions" class="nav-link {{(request()->segment(1)=='statements') ? 'active' : '' }}" aria-controls="applicationsExamples" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <svg width="12px" height="12px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>settings</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF" fill-rule="nonzero">
                            <g transform="translate(1716.000000, 291.000000)">
                            <g transform="translate(304.000000, 151.000000)">
                            <polygon class="color-background" opacity="0.596981957" points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667"></polygon>
                            <path class="color-background" d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z" opacity="0.596981957"></path>
                            <path class="color-background" d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z"></path>
                            </g>
                            </g>
                            </g>
                            </g>
                            </svg>
                        </div>
                    <span class="nav-link-text ms-1">Account Statement</span>
                    </a>
                        <div class="{{(request()->segment(1)=='statements') ? '' : 'collapse' }}" id="appliions" style="">
                            <ul class="nav ms-4 ps-3">
                                <li class="nav-item ">
                                    <a class="nav-link {{(request()->segment(1)=='statements' && request()->segment(2)=='')  ? 'active' : '' }}" href="{{route('statements.index')}}">
                                        <span class="sidenav-mini-icon">k</span>
                                        <span class="sidenav-normal">View Statements</span>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link {{(request()->segment(1)=='statements' && request()->segment(2)=='create') ? 'active' : '' }}" href="{{route('statements.create')}}">
                                        <span class="sidenav-mini-icon">k</span>
                                        <span class="sidenav-normal">Add Statement</span>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link {{(request()->segment(1)=='statement' && request()->segment(2)=='upload') ? 'active' : '' }}" href="{{route('statement.upload')}}">
                                        <span class="sidenav-mini-icon">k</span>
                                        <span class="sidenav-normal">Batch Upload</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                </li>
                <!-- invoices menu ends  -->
                <!-- customer menu starts  -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#applicationsExampl" class="nav-link {{(request()->segment(1)=='customers') ? 'active' : '' }}  " aria-controls="applicationsExamples" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <svg width="12px" height="12px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>settings</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF" fill-rule="nonzero">
                            <g transform="translate(1716.000000, 291.000000)">
                            <g transform="translate(304.000000, 151.000000)">
                            <polygon class="color-background" opacity="0.596981957" points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667"></polygon>
                            <path class="color-background" d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z" opacity="0.596981957"></path>
                            <path class="color-background" d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z"></path>
                            </g>
                            </g>
                            </g>
                            </g>
                            </svg>
                        </div>
                    <span class="nav-link-text ms-1">{{__('labels.customers')}}</span>
                    </a>
                        <div class="{{(request()->segment(1)=='customers')  ? '' : 'collapse' }}" id="applicationsExampl" style="">
                            <ul class="nav ms-4 ps-3">
                                <li class="nav-item ">
                                    <a class="nav-link {{(request()->segment(1)=='customers') && (request()->segment(2)=='create')   ? 'active' : '' }}" href="{{route('customers.create')}}">
                                        
                                        <span class="sidenav-normal">Add Customer</span>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{(request()->segment(1)=='customers') && (request()->segment(2)=='')  ? 'active' : '' }}" href="{{route('customers.index')}}">
                                        
                                        <span class="sidenav-normal">Approved Customers</span>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link {{(request()->segment(1)=='customers') && (request()->segment(2)=='list')  ? 'active' : '' }}" href="{{route('customers.list')}}">
                                        
                                        <span class="sidenav-normal">Pending Approval</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                </li>
                <!-- customer menu ends  -->
              
                <!-- admin menu starts  -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#applicationsExam" class="nav-link collapsed" aria-controls="applicationsExamples" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <svg width="12px" height="12px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>settings</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF" fill-rule="nonzero">
                            <g transform="translate(1716.000000, 291.000000)">
                            <g transform="translate(304.000000, 151.000000)">
                            <polygon class="color-background" opacity="0.596981957" points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667"></polygon>
                            <path class="color-background" d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z" opacity="0.596981957"></path>
                            <path class="color-background" d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z"></path>
                            </g>
                            </g>
                            </g>
                            </g>
                            </svg>
                        </div>
                    <span class="nav-link-text ms-1">{{__('labels.users')}}</span>
                    </a>
                        <div class="collapse" id="applicationsExam" style="">
                            <ul class="nav ms-4 ps-3">
                                <li class="nav-item ">
                                    <a class="nav-link " href="{{route('admins.index')}}">
                                        
                                        <span class="sidenav-normal">{{__('labels.view_user')}}</span>
                                    </a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link " href="{{route('admins.create')}}">
                                        
                                        <span class="sidenav-normal">{{__('labels.add_user')}}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                </li>
                <!-- admin menu ends  -->
                <!-- settings start  -->
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#applicationsExa" class="nav-link collapsed" aria-controls="applicationsExamples" role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <svg width="12px" height="12px" viewBox="0 0 40 40" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                            <title>settings</title>
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g transform="translate(-2020.000000, -442.000000)" fill="#FFFFFF" fill-rule="nonzero">
                            <g transform="translate(1716.000000, 291.000000)">
                            <g transform="translate(304.000000, 151.000000)">
                            <polygon class="color-background" opacity="0.596981957" points="18.0883333 15.7316667 11.1783333 8.82166667 13.3333333 6.66666667 6.66666667 0 0 6.66666667 6.66666667 13.3333333 8.82166667 11.1783333 15.315 17.6716667"></polygon>
                            <path class="color-background" d="M31.5666667,23.2333333 C31.0516667,23.2933333 30.53,23.3333333 30,23.3333333 C29.4916667,23.3333333 28.9866667,23.3033333 28.48,23.245 L22.4116667,30.7433333 L29.9416667,38.2733333 C32.2433333,40.575 35.9733333,40.575 38.275,38.2733333 L38.275,38.2733333 C40.5766667,35.9716667 40.5766667,32.2416667 38.275,29.94 L31.5666667,23.2333333 Z" opacity="0.596981957"></path>
                            <path class="color-background" d="M33.785,11.285 L28.715,6.215 L34.0616667,0.868333333 C32.82,0.315 31.4483333,0 30,0 C24.4766667,0 20,4.47666667 20,10 C20,10.99 20.1483333,11.9433333 20.4166667,12.8466667 L2.435,27.3966667 C0.95,28.7083333 0.0633333333,30.595 0.00333333333,32.5733333 C-0.0583333333,34.5533333 0.71,36.4916667 2.11,37.89 C3.47,39.2516667 5.27833333,40 7.20166667,40 C9.26666667,40 11.2366667,39.1133333 12.6033333,37.565 L27.1533333,19.5833333 C28.0566667,19.8516667 29.01,20 30,20 C35.5233333,20 40,15.5233333 40,10 C40,8.55166667 39.685,7.18 39.1316667,5.93666667 L33.785,11.285 Z"></path>
                            </g>
                            </g>
                            </g>
                            </g>
                            </svg>
                        </div>
                    <span class="nav-link-text ms-1">{{__('labels.settings')}}</span>
                    </a>
                        <div class="collapse" id="applicationsExa" style="">
                            <ul class="nav ms-4 ps-3">
                                <li class="nav-item ">
                                    <a class="nav-link " href="{{route('change_password_admin')}}">
                                        
                                        <span class="sidenav-normal"> {{__('labels.change_password')}}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                </li>
                
                <!-- setting ends  -->
            </ul>
        </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
   @include('components.navbaradmin')
    @yield('content')
  </main>
  <!--   Core JS Files   -->
  <script src="{{asset('soft-theme/assets/js/core/popper.min.js')}}"></script>
  <script src="{{asset('soft-theme/assets/js/core/bootstrap.min.js')}}"></script>
  <script src="{{asset('soft-theme/assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
  <script src="{{asset('soft-theme/assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
  <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
  
  @yield('scripts')
  
  @livewireScripts
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="{{asset('soft-theme/assets/js/plugins/dragula/dragula.min.js')}}"></script>
  <script src="{{asset('soft-theme/assets/js/plugins/jkanban/jkanban.js')}}"></script>
  <script src="{{asset('soft-theme/assets/js/plugins/chartjs.min.js')}}"></script> 
  <script>
    var ctx1 = document.getElementById("chart-line-1").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.02)');
    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

    var ctx2 = document.getElementById("chart-line-2").getContext("2d");

    new Chart(ctx1, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Visitors",
          tension: 0.5,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#cb0c9f",
          borderWidth: 2,
          backgroundColor: gradientStroke1,
          data: [50, 45, 60, 60, 80, 65, 90, 80, 100],
          maxBarThickness: 6,
          fill: true
        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#9ca2b7'
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#9ca2b7'
            }
          },
        },
      },
    });

    new Chart(ctx2, {
      type: "line",
      data: {
        labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: "Income",
          tension: 0.5,
          borderWidth: 0,
          pointRadius: 0,
          borderColor: "#cb0c9f",
          borderWidth: 2,
          backgroundColor: gradientStroke1,
          data: [60, 80, 75, 90, 67, 100, 90, 110, 120],
          maxBarThickness: 6,
          fill: true
        }],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: false,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              callback: function(value, index, values) {
                return '$' + value;
              },
              display: true,
              padding: 10,
              color: '#9ca2b7'
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#9ca2b7'
            }
          },
        },
      },
    });
  </script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
      </script>


    
      <script>

            @if(Session::has('success'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
                    toastr.success("{{ session('success') }}");
            @endif

            @if(Session::has('error'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
                    toastr.error("{{ session('error') }}");
            @endif
       </script>
       
       
       <script>
            $('.customer_no').each(function(index , element){
                const inv = $(element).val();
                var url = '{{ route("getCustomerName", ":id") }}';
                var selectCustomer = $(element).parent().parent().parent().find('#dynamic-name');
                url = url.replace(':id', inv);
                $.ajax({
                    type: 'get',
                    url: url,
                    async:false,
                    dataType: 'json',
                    success: function(response) {
                    selectCustomer.val(response);
                    }
                });
            });
            
            $(document).on('change','#user_id',function(){
            var id = $(this).val();
            console.log(id);
            var url = '{{ route("getCustomerNo", ":id") }}';
            url = url.replace(':id', id);
            $.ajax({
                type: 'get',
                url: url,
                dataType: 'json',
                success: function(response) {
                    $('#customer_no').val(response);

                }
                });
            });
       </script>
       
      
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{asset('soft-theme/assets/js/soft-ui-dashboard.min.js?v=1.0.9')}}"></script>
</body>

</html>