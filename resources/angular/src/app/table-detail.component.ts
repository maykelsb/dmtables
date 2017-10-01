import { Component, Input, OnInit } from '@angular/core';
import { ActivatedRoute, ParamMap } from '@angular/router';
import { Location } from '@angular/common';

import 'rxjs/add/operator/switchMap';

import { Table } from './table';
import { TableService } from './table.service';

@Component({
  selector: 'table-detail',
  templateUrl: './table-detail.component.html',
})
export class TableDetailComponent implements OnInit {
  @Input() table: Table;

  constructor(
    private tableService: TableService,
    private route: ActivatedRoute,
    private location: Location
  ) {}

  ngOnInit(): void {
    this.route.paramMap
      .switchMap((params: ParamMap) => this.tableService.getTable(+params.get('id')))
      .subscribe(table => this.table = table);
  }

  goBack(): void {
    this.location.back();
  }
}

