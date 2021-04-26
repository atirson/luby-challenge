import axios from 'axios';

export const api = axios.create({
  baseURL: 'http://localhost:8000/',
});

export const token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXV0aFwvbG9naW4iLCJpYXQiOjE2MTkzNzYyNjksImV4cCI6MTYyMDAyNDI2OSwibmJmIjoxNjE5Mzc2MjY5LCJqdGkiOiJUMG12djlCMUtwZXJZczh0Iiwic3ViIjo4LCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.WRxjJcnb4knKCUDy5xkhdvY6JSqdceUvJTpW4bmZM5I';
