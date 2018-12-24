import { Artist } from './artist';
import { Time } from '@angular/common';

export class Music {
  id: number;
  titre: string;
  duree: string;
  genre: string;
  artiste: Artist;
  date: Date;
}
