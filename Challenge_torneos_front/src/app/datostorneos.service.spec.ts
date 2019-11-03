import { TestBed } from '@angular/core/testing';

import { DatostorneosService } from './datostorneos.service';

describe('DatostorneosService', () => {
  beforeEach(() => TestBed.configureTestingModule({}));

  it('should be created', () => {
    const service: DatostorneosService = TestBed.get(DatostorneosService);
    expect(service).toBeTruthy();
  });
});
