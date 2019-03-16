/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   ft_ls.h                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: malallai <malallai@student.42.fr>          +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/03/16 14:02:37 by malallai          #+#    #+#             */
/*   Updated: 2019/03/16 19:00:12 by malallai         ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

#ifndef FT_LS_H
# define FT_LS_H
# include <dirent.h>
# include <sys/types.h>
# include <sys/stat.h>
# include <pwd.h>
# include <uuid/uuid.h>
# include <grp.h>
# include <sys/xattr.h>
# include <time.h>
# include <stdio.h>
# include "libft/libft.h"

# define F_DIR (char)'d'
# define F_LINK (char)'l'

# define DEBUG printf

typedef struct			s_entry
{
	struct dirent		*dirent;
	struct s_entry		*next;
}						t_entry;

typedef struct			s_opt
{
	int					flag;
	char				**argv;
	char				**folders;
	char				**files;
	int					files_count;
	int					folders_count;
	int					current;
	t_entry				*entries;
	t_entry				*first_entry;
}						t_opt;

t_entry					*new_entry(void);
void					add_entry(t_opt *opt, struct dirent *dirent);
void					free_entries(t_entry *entry);
t_opt					*new_opt(void);
void					set_opt_folders(t_opt *opt, int argc, char **argv,
						int index);
void					free_opt(t_opt *opt);
char					get_dtype(unsigned char type);
char					*get_color(char type, int mode);
int						set_flag(char c_flag, t_opt *opt);
int						parse(char **argv, t_opt *opt);
int						ls_read(t_opt *opt);
void					free_array(char **array);
int						is_regular_file(const char *path);
int						is_folder(const char *path);

#endif
