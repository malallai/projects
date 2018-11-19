NAME = gnl
PROJECT_NAME = Get Next Line

SOURCES_FOLDER = sources/
INCLUDES_FOLDER = .
OBJECTS_FOLDER = objects/

SOURCES = \
	main.c \
	get_next_line.c \

OBJECTS = $(SOURCES:.c=.o)
OBJECTS := $(subst /,__,$(OBJECTS))
OBJECTS := $(addprefix $(OBJECTS_FOLDER),$(OBJECTS))

FLAGS = -Wall -Wextra -Werror -fPIC
CC = clang

NO_COLOR =		\033[38;5;0m
OK_COLOR =		\033[38;5;2m
ERROR_COLOR =	\033[38;5;1m
WARN_COLOR =	\033[38;5;3m
SILENT_COLOR =	\033[38;5;245m
INFO_COLOR =	\033[38;5;45m

.PHONY: all re clean fclean libft

all: $(NAME)

$(NAME): libft $(OBJECTS)
	@$(CC) $(FLAGS) -I$(INCLUDES_FOLDER) -o $(NAME) $(OBJECTS) -L libft/ -lft
	@echo "$(WARN_COLOR)$(NAME) successfully compiled. $(OK_COLOR)✓$(NO_COLOR)"

libft:
	@make -C libft re

$(OBJECTS_FOLDER)%.o: %.c
	@$(CC) $(FLAGS) -I$(INCLUDES_FOLDER) -c $< -o $@
	@printf "$(INFO_COLOR)$<$(SILENT_COLOR)\t➤ $(INFO_COLOR)$@ $(NO_COLOR)"
	@echo "$(OK_COLOR)✓ $(NO_COLOR)"

clean:
	@rm -f $(OBJECTS)
	@echo "$(WARN_COLOR)$(PROJECT_NAME) $(SILENT_COLOR): $(WARN_COLOR)Clean $(OK_COLOR)✓.$(NO_COLOR)"

fclean: clean
	@rm -f $(NAME)
	@echo "$(WARN_COLOR)$(PROJECT_NAME) $(SILENT_COLOR): $(WARN_COLOR)Fclean $(OK_COLOR)✓.$(NO_COLOR)"

re: fclean all
