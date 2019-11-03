import { Injectable } from '@angular/core';
import { HttpClient, HttpErrorResponse, HttpParams } from
  '@angular/common/http';
import { environment } from '../environments/environment'

@Injectable({
  providedIn: 'root'
})
export class DatostorneosService {

  constructor(public http: HttpClient) { }



  public getWinners() {
    const apiUrl: string = environment.apiBaseUrl +
      'winners';
    let promise = new Promise((resolve, reject) => {
      return this.http.get(apiUrl)
        .subscribe(respose => {
          return resolve(respose);
        }, (err: HttpErrorResponse) => {
          return reject(err.message);
        });
    });
    return promise;

  }
  getPlayers() {
    const apiUrl: string = environment.apiBaseUrl +
      'players';
    let promise = new Promise((resolve, reject) => {
      return this.http.get(apiUrl)
        .subscribe(respose => {
          return resolve(respose);
        }, (err: HttpErrorResponse) => {
          return reject(err.message);
        });
    });
    return promise;

  }
  async getUltimoGanado(id) {
    console.log(id);
    const apiUrl: string = environment.apiBaseUrl +
      'LastWin';
    let promise = new Promise((resolve, reject) => {
      return this.http.get(apiUrl, {
        params: new HttpParams().set("id", id)
      })
        .subscribe(respose => {
          return resolve(respose);
        }, (err: HttpErrorResponse) => {
          return reject(err.message);
        });
    });
    return promise;


  }
}

//HttpParams().set("school_id", schoolId.toString())