const axios = require('axios');

const userData = {
    name: "Test User " + Date.now(),
    email: "test" + Date.now() + "@example.com",
    password: "password123",
    password_confirmation: "password123"
};

async function testRegister() {
    try {
        const response = await axios.post('http://localhost:8000/api/register', userData, {
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        });
        console.log('Registration successful:', response.data);
    } catch (error) {
        if (error.response) {
            console.error('Registration failed with status:', error.response.status);
            console.error('Response data:', error.response.data);
        } else {
            console.error('Network error or no response:', error.message);
        }
    }
}

testRegister();
