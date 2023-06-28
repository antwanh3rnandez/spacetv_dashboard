
// Helper / Utility functions
let url_to_head = (url) => {
    return new Promise(function(resolve, reject) {
        var script = document.createElement('script');
        script.src = url;
        script.onload = function() {
            resolve();
        };
        script.onerror = function() {
            reject('Error loading script.');
        };
        document.head.appendChild(script);
    });
}
let handle_close = (event) => {
    event.target.closest(".ms-alert").remove();
}
let handle_click = (event) => {
    if (event.target.classList.contains("ms-close")) {
        handle_close(event);
    }
}
document.addEventListener("click", handle_click);
const paypal_sdk_url = "https://www.paypal.com/sdk/js";
const client_id = "AaEfl5Bv18Xb1774qZ48rWqzoq56zX29ThMmUrn1_iT_RkuNE7kA6xUJ79NQcdrSlk3IFzFTXmrNcnGV";
const currency = "USD";
const intent = "capture";
let alerts = document.getElementById("alerts");
let alerta = document.getElementById("alerta");

let username = "jorgehdz";
let password = "wanhertvplus1598";

let price;
let timePurchase;
let timeMonthsToAdd;

//PayPal Code
//https://developer.paypal.com/sdk/js/configuration/#link-queryparameters
url_to_head(paypal_sdk_url + "?client-id=" + client_id + "&enable-funding=venmo&currency=" + currency + "&intent=" + intent)
.then(() => {
    //Handle loading spinner
    document.getElementById("loading").classList.add("hide");
    document.getElementById("content").classList.remove("hide");
    let alerts = document.getElementById("alerts");
    let paypal_buttons = paypal.Buttons({ // https://developer.paypal.com/sdk/js/reference
        onClick: (data) => { // https://developer.paypal.com/sdk/js/reference/#link-oninitonclick
            //Custom JS here
        },
        style: { //https://developer.paypal.com/sdk/js/reference/#link-style
            shape: 'rect',
            color: 'black',
            layout: 'vertical',
            label: 'paypal'
        },

        createOrder: function(data, actions) { 
            //https://developer.paypal.com/docs/api/orders/v2/#orders_create
            let priceElement = document.getElementById("price");
            price = priceElement ? priceElement.innerText.trim() : "";
            console.log(price);
            return fetch("http://127.0.0.1:3000/create_order", {
                method: "post", headers: { "Content-Type": "application/json; charset=utf-8" },
                body: JSON.stringify({ "intent": intent, "price": price })
            })
            .then((response) => response.json())
            .then((order) => { return order.id; });
        },

        onApprove: function(data, actions) {
            let order_id = data.orderID;
            return fetch("http://127.0.0.1:3000/complete_order", {
              method: "post",
              headers: { "Content-Type": "application/json; charset=utf-8" },
              body: JSON.stringify({
                "intent": intent,
                "order_id": order_id
              })
            })
              .then((response) => response.json())
              .then((order_details) => {
                console.log(order_details);
                let intent_object = intent === "authorize" ? "authorizations" : "captures";
                let amount = order_details.purchase_units[0].payments[intent_object][0].amount.value;
                alerts.innerHTML = `<div class=\'ms-alert alert-successs\'>Estimad@ ` + order_details.payer.name.given_name + ` ` + order_details.payer.name.surname + ` fue cobrado con exito el pago de ` + order_details.purchase_units[0].payments[intent_object][0].amount.value + ` ` + order_details.purchase_units[0].payments[intent_object][0].amount.currency_code + `!</div>`;
          
                // Verificamos que exista la cuenta
                let apiUrl = "http://158.69.225.52:25461/api.php?action=user";
                let post_data = {
                  username: username,
                  password: password
                };
          
                let requestOptions = {
                  method: "POST",
                  headers: { "Content-Type": "application/x-www-form-urlencoded" },
                  body: new URLSearchParams(post_data)
                };
          
                return fetch(apiUrl + "&sub=info", requestOptions)
                  .then(response => response.json())
                  .then(api_result => {
                    if (!api_result || !api_result.user_info) {
                      console.log("Failed to retrieve user information");
                    } else {
                      console.log(api_result);
                      username = api_result.user_info.username || "";
                      password = api_result.user_info.password || "";
                      let expiraTimestamp = parseInt(api_result.user_info.exp_date) || 0;
                    //   let nowTimestamp = api_result.server_info.timestamp_now || "";
                      let nowTimestamp = Math.floor(Date.now() / 1000) || "";

                      let fecha;
                      let nuevo_timestamp;

                    //   if (amount === 11.00) {
                    //     timePurchase = '1 mes';
                    //     timeMonthsToAdd = 1;
                    //   }else if(amount === 22.00){
                    //     timePurchase = '2 meses';
                    //     timeMonthsToAdd = 2;
                    //   }else if(amount === 55.00){
                    //     timePurchase = '1 semestre';
                    //     timeMonthsToAdd = 6;
                    //   }else if(amount === 110.00){
                    //     timePurchase = '2 semestres';
                    //     timeMonthsToAdd = 12;
                    //   }else if(amount === 100.00){
                    //     timePurchase = '1 anualidad';
                    //     timeMonthsToAdd = 12;
                    //   }else if(amount === 200.00){
                    //     timePurchase = '2 anualidades';
                    //     timeMonthsToAdd = 24;
                    //   }

                    if (Math.abs(amount - 11.00) < 0.01) {
                        timePurchase = '1 mes';
                        timeMonthsToAdd = 1;
                      } else if (Math.abs(amount - 22.00) < 0.01) {
                        timePurchase = '2 meses';
                        timeMonthsToAdd = 2;
                      } else if (Math.abs(amount - 55.00) < 0.01) {
                        timePurchase = '1 semestre';
                        timeMonthsToAdd = 6;
                      } else if (Math.abs(amount - 110.00) < 0.01) {
                        timePurchase = '2 semestres';
                        timeMonthsToAdd = 12;
                      } else if (Math.abs(amount - 100.00) < 0.01) {
                        timePurchase = '1 anualidad';
                        timeMonthsToAdd = 12;
                      } else if (Math.abs(amount - 200.00) < 0.01) {
                        timePurchase = '2 anualidades';
                        timeMonthsToAdd = 24;
                      }
          
                      if (expiraTimestamp > nowTimestamp) {
                        fecha = new Date(expiraTimestamp * 1000);
                        fecha.setMonth(fecha.getMonth() + timeMonthsToAdd);
                        nuevo_timestamp = Math.floor(fecha.getTime() / 1000);
                        
                      } else {
                        fecha = new Date(nowTimestamp * 1000);
                        fecha.setMonth(fecha.getMonth() + timeMonthsToAdd);
                        nuevo_timestamp = Math.floor(fecha.getTime() / 1000);
                      }

                      const post_data2 = {
                        username: username,
                        password: password,
                        user_data: {
                          member_id: 1,
                          exp_date: nuevo_timestamp
                        }
                      };
                      
                      const formData = new URLSearchParams();
                      
                      Object.keys(post_data2).forEach(key => {
                        if (typeof post_data2[key] === 'object') {
                          Object.keys(post_data2[key]).forEach(innerKey => {
                            formData.append(`${key}[${innerKey}]`, post_data2[key][innerKey]);
                          });
                        } else {
                          formData.append(key, post_data2[key]);
                        }
                      });
                      
                      const encodedData = formData.toString();
        
                      let requestOptions2 = {
                        method: "POST",
                        headers: { "Content-Type": "application/x-www-form-urlencoded" },
                        body: new URLSearchParams(encodedData)
                      };
                      
                      // Renovamos la cuenta que verificamos anteriormente
                      return fetch(apiUrl + "&sub=edit", requestOptions2)
                        .then((response) => response.json())
                        .then((api_result2) => {
                            alerta = document.getElementById("alerta");
                            alerta.innerHTML = `<div class='ms-alert ms-action'>Gracias por su preferencia, su cuenta: ${username} ha sido renovada por (${timePurchase}), gracias por continuar siendo parte de la familia SpaceTV+!</div>`;
                            console.log(api_result2);
                        });

                    }
                  });
              })
              .then(() => {
                paypal_buttons.close();
              })
              .catch((error) => {
                console.log(error);
                alerts.innerHTML = `<div class="ms-alert alert-error ms-small"><span class="ms-close"></span><p>Ocurrio un error con su pago!</p></div>`;
              });
          },
          

        onCancel: function (data) {
            alerts.innerHTML = `<div class="ms-alert alert-error ms-small"><span class="ms-close"></span><p>Compra cancelada!</p>  </div>`;
        },

        onError: function(err) {
            console.log(err);
        }
    });
    paypal_buttons.render('#payment_options');
})
.catch((error) => {
    console.error(error);
});
