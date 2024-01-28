package com.example.child_game.controllers;

import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PostMapping;

import com.example.child_game.models.Game;
import com.example.child_game.repositories.ChildRepository;
import com.example.child_game.repositories.GameRepository;

@Controller
public class GameController {
    
    final GameRepository repo;
    final ChildRepository childRepo;

    public GameController(GameRepository repo, ChildRepository childRepo) {
        this.repo = repo;
        this.childRepo = childRepo;
    }

    @GetMapping("/games")
    String index(Model model){
        model.addAttribute("games", repo.findAll());
        return "/games/index";
    }

    @GetMapping("/games/create")
    String create(Model model){
        model.addAttribute("children", childRepo.findAll());
        return "/games/create";
    }

    @PostMapping("/games/store")
    String store(Game g){
        repo.save(g);
        return "redirect:/games";
    }

    @GetMapping("/games/show")
    String show(Model model, Long id){
        model.addAttribute("g", repo.findById(id).orElse(null));
        return "/games/show";
    }

    @GetMapping("/games/edit")
    String edit(Model model, Long id){
        model.addAttribute("children", childRepo.findAll());
        model.addAttribute("g", repo.findById(id).orElse(null));
        return "/games/edit";
    }

    @PostMapping("/games/update")
    String update(Game g){
        repo.save(g);
        return "redirect:/games";
    }

    @PostMapping("/games/destroy")
    String destroy(Long id){
        repo.deleteById(id);
        return "redirect:/games";
    }

    @GetMapping("/games/increasePrice")
    String increasePrice(Long id, Integer percentage, Model model){
        repo.increasePrice(id, percentage);
        return show(model, id);
    }

    @GetMapping("/games/increaseAllPrices")
    String increaseAllPrices(Integer percentage){
        repo.increaseAllPrices(percentage);
        return "redirect:/games";
    }
}
