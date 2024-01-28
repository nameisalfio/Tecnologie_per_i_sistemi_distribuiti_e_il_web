package com.example.child_game.repositories;

import org.springframework.data.jpa.repository.JpaRepository;
import com.example.child_game.models.Game;

public interface GameRepository extends JpaRepository<Game, Long>{
    
    default void increasePrice(Long id, Integer percentage) {
        Game g = findById(id).orElse(null);
        g.setPrice(g.getPrice() * (1 + percentage/100.0));
        this.save(g);
    }

    default void increaseAllPrices(Integer percentage) {
        findAll().stream()
                 .forEach(g -> {g.setPrice(g.getPrice() * (1 + percentage/100.0)); this.save(g);});
    }
}
