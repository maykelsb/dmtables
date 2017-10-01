import { Component, Input } from '@angular/core';
import { Table } from './table';

@Component({
  selector: 'table-detail',
  template: `
<div *ngIf="table">
  <h2>Tabela: {{table.name}}</h2>
  <div><label>id: </label>{{table.id}}</div>
  <div>
    <label>name: </label>
    <input [(ngModel)]="table.name" placeholder="name">
  </div>
</div>
  `,
})
export class TableDetailComponent {
  @Input() table: Table;
}

