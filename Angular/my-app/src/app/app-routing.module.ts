import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { ArtistsComponent } from './artists/artists.component';
import { MusicsComponent } from './musics/musics.component';

const routes: Routes = [
    { path: 'artists', component: ArtistsComponent },
    { path: 'musics', component: MusicsComponent }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
