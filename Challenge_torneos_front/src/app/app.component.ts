import { Component } from '@angular/core';
import { DatostorneosService } from './datostorneos.service';
import { NgxSpinnerService } from "ngx-spinner";
class Torneo_response{
  torneo : any;
  ganador : any;
};

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})

export class AppComponent{
  public title = 'Torneos';
  public torneos:any;
  public players:any;
  public jugador:any;
  public ultimoGanado:any;
  public grandSlam:any;
  public tabla:boolean;
  public datos:boolean;
  constructor(private service:DatostorneosService,private spinner: NgxSpinnerService){
    this.spinner.show();
    this.tabla=true;
    this.datos=false;
  }
async ngOnInit(){
  
  this.service.getPlayers().then(async result =>{
    this.players=result;    
    this.torneos = await this.service.getWinners();
    console.log(this.players);
    console.log(this.torneos);
    for(let posicion in this.torneos){
       let torneo = this.torneos[posicion];
       console.log(await this.Search(torneo.ganador,this.players));
       this.torneos[posicion]={torneo:torneo.torneo
        ,ganador:await this.Search(this.torneos[posicion].ganador,result),idGanador:this.torneos[posicion].ganador};
    }   
    this.spinner.hide();
  });
  console.log("termine");
  
}
 async ultimaVez(item){
    console.log(item);
    this.title="Detalle del Jugador";
    this.tabla=false;
    this.datos=true;
    this.jugador=item.ganador;
    this.grandSlam=item.torneo;
    this.ultimoGanado = await this.service.getUltimoGanado(item.idGanador);
  }
  async Search(id,players){
    for (let player in players){
      
      if(players[player].id==id){
        console.log(players[player].nombre);
        return players[player].nombre;
     }
    }
    
  }
  volver(){
    console.log("volver");
    this.tabla=true;
    this.datos=false;
    this.ultimoGanado="";
    this.grandSlam="";
    this.jugador="";
  }
 
}
