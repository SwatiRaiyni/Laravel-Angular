import { AuthserviceService } from 'src/app/Services/authservice.service';
import { Component, OnInit } from '@angular/core';
import { TokenService } from 'src/app/Services/token.service';
import { Router } from '@angular/router';
import { AuthService } from 'src/app/Services/auth.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

  
  constructor(
    private auth:AuthserviceService,
    private Token:TokenService,
    private router:Router,
    private checkAuth:AuthService

    ){}
  ngOnInit(): void {
  }
  public form ={
    email :'swati@gmail.com',
    password:'passowrd'
  };
  public error =null;
  onSubmit(data:any){
    console.log(data);
    this.auth.login(data).subscribe(
      data => this.handleResponse(data),

      error =>this.handleError(error)

    );
  }

  handleError(error:any){
    this.error = error.error.error;
  } 

  handleResponse(data:any){
    this.Token.handle(data.access_token);
    this.checkAuth.changeAuthStatus(true);
    this.router.navigateByUrl('/profile');
  }

}
  
  


