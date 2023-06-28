import dotenv from 'dotenv';
import express from 'express';
import fetch from 'node-fetch';
import cors  from 'cors';
// import 'dotenv/config';

dotenv.config({ path: '.env' })

const app = express();
app.use(express.json());
app.use(express.urlencoded({
    extended: true
}));

const corsOptions = {
    origin: ['http://127.0.0.1', 'http://localhost'],
};

app.use(cors(corsOptions));

const port = 3000;
const environment = process.env.ENVIRONMENT;
const client_id = environment === 'sandbox' ? process.env.CLIENT_ID_SB : process.env.CLIENT_SECRET_LIVE;
const client_secret = environment === 'sandbox' ?  process.env.CLIENT_SECRET_SB : process.env.CLIENT_SECRET_LIVE;
const endpoint_url = environment === 'sandbox' ? 'https://api-m.sandbox.paypal.com' : 'https://api-m.paypal.com';


console.log(client_id);
console.log(client_secret);

/**
 * Creates an order and returns it as a JSON response.
 * @function
 * @name createOrder
 * @memberof module:routes
 * @param {object} req - The HTTP request object.
 * @param {object} req.body - The request body containing the order information.
 * @param {string} req.body.intent - The intent of the order.
 * @param {object} res - The HTTP response object.
 * @returns {object} The created order as a JSON response.
 * @throws {Error} If there is an error creating the order.
 */
app.post('/create_order', (req, res) => {
    get_access_token()
        .then(access_token => {
            let order_data_json = {
                'intent': req.body.intent.toUpperCase(),
                'purchase_units': [{
                    'amount': {
                        'currency_code': 'USD',
                        'value': req.body.price,
                    }
                }]
            };
            const data = JSON.stringify(order_data_json)

            fetch(endpoint_url + '/v2/checkout/orders', { //https://developer.paypal.com/docs/api/orders/v2/#orders_create
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${access_token}`
                    },
                    body: data
                })
                .then(res => res.json())
                .then(json => {
                    res.send(json);
                }) //Send minimal data to client
        })
        .catch(err => {
            console.log(err);
            res.status(500).send(err)
        })
});

/**
 * Completes an order and returns it as a JSON response.
 * @function
 * @name completeOrder
 * @memberof module:routes
 * @param {object} req - The HTTP request object.
 * @param {object} req.body - The request body containing the order ID and intent.
 * @param {string} req.body.order_id - The ID of the order to complete.
 * @param {string} req.body.intent - The intent of the order.
 * @param {object} res - The HTTP response object.
 * @returns {object} The completed order as a JSON response.
 * @throws {Error} If there is an error completing the order.
 */
app.post('/complete_order', (req, res) => {
    get_access_token()
        .then(access_token => {
            fetch(endpoint_url + '/v2/checkout/orders/' + req.body.order_id + '/' + req.body.intent, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${access_token}`
                    }
                })
                .then(res => res.json())
                .then(json => {
                    console.log(json);
                    res.send(json);
                }) //Send minimal data to client
        })
        .catch(err => {
            console.log(err);
            res.status(500).send(err)
        })
});

// Helper / Utility functions

//Servers the index.html file
app.get('/', (req, res) => {
    res.sendFile(process.cwd() + '/index.html');
});
//Servers the style.css file
app.get('/style.css', (req, res) => {
    res.sendFile(process.cwd() + '/style.css');
});
//Servers the script.js file
app.get('/script.js', (req, res) => {
    res.sendFile(process.cwd() + '/script.js');
});
//Imagenes
app.get('/images/1-mes.png', (req, res) => {
    res.sendFile(process.cwd() + '/images/1-mes.png');
});
app.get('/images/2-meses.png', (req, res) => {
    res.sendFile(process.cwd() + '/images/2-meses.png');
});
app.get('/images/6-meses.png', (req, res) => {
    res.sendFile(process.cwd() + '/images/6-meses.png');
});
app.get('/images/12-meses.png', (req, res) => {
    res.sendFile(process.cwd() + '/images/12-meses.png');
});
app.get('/images/24-meses.png', (req, res) => {
    res.sendFile(process.cwd() + '/images/24-meses.png');
});

//PayPal Developer YouTube Video:
//How to Retrieve an API Access Token (Node.js)
//https://www.youtube.com/watch?v=HOkkbGSxmp4
function get_access_token() {
    const auth = `${client_id}:${client_secret}`
    const data = 'grant_type=client_credentials'
    return fetch(endpoint_url + '/v1/oauth2/token', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'Authorization': `Basic ${Buffer.from(auth).toString('base64')}`
            },
            body: data
        })
        .then(res => res.json())
        .then(json => {
            return json.access_token;
        })
        .catch(err => {
            console.error(err);
            throw new Error('Error getting access token');
        });
}

app.listen(port, () => {
    console.log(`Server listening at http://localhost:${port}`)
})


