import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';
import { AuthserviceService } from 'src/app/Services/authservice.service';
import { TokenService } from 'src/app/Services/token.service';
 
@Component({
  selector: 'app-signup',
  templateUrl: './signup.component.html',
  styleUrls: ['./signup.component.scss']
})
export class SignupComponent implements OnInit {

  constructor(private auth:AuthserviceService , 
    private Token :TokenService,
    private router:Router) { }

  ngOnInit(): void {
  }
  
  public form = {
    email : null,
    name : null,
    password: null,
    password_confirm : null
  }
  public errorsall = {'email': '','password':null,'name':null , 'password_confirm':null};
  onSubmit(data:any){
    console.log(data);
    this.auth.signup(data).subscribe(
      data => this.handleResponse(data),
      error =>this.handleError(error)
    );  
  }
  public email:any;
  handleError(error:any){
    this.errorsall = error.error.errors;
    //console.log(error.error.errors);
  } 

  handleResponse(data:any){
    this.Token.handle(data.access_token);
    this.router.navigateByUrl('/profile');
  }

}
