/* ************************************************************************** */
/*                                                                            */
/*                                                        :::      ::::::::   */
/*   utils.c                                            :+:      :+:    :+:   */
/*                                                    +:+ +:+         +:+     */
/*   By: bclerc <bclerc@student.42.fr>              +#+  +:+       +#+        */
/*                                                +#+#+#+#+#+   +#+           */
/*   Created: 2019/02/02 16:25:40 by bclerc            #+#    #+#             */
/*   Updated: 2019/02/28 13:02:19 by bclerc           ###   ########.fr       */
/*                                                                            */
/* ************************************************************************** */

# include "ft_ls.h"

char	*print_mode(int mode, unsigned char type)
{
	char perm[11];

	perm[0] = get_dtype(type); 
	perm[1] = (mode & S_IWUSR) && (mode & S_IWRITE) ? 'r' : '-';
	perm[2] = (mode & S_IWUSR) && (mode & S_IWRITE) ? 'w' : '-';
	perm[3] = (mode & S_IXUSR) && (mode & S_IEXEC) ? 'x' : '-';
	perm[4] = (mode & S_IRGRP) && (mode & S_IREAD) ? 'r' : '-';
	perm[5] = (mode & S_IWGRP) && (mode & S_IWRITE) ? 'w' : '-';
	perm[6] = (mode & S_IXGRP) && (mode & S_IEXEC) ? 'x' : '-';
	perm[7] = (mode & S_IROTH) && (mode & S_IREAD) ? 'r' : '-';
	perm[8] = (mode & S_IWOTH) && (mode & S_IWRITE) ? 'w' : '-';
	perm[9] = (mode & S_IXOTH) && (mode & S_IEXEC) ? 'x' : '-';
	perm[10] = 0;
	return (ft_strdup(perm));
}

char get_dtype(unsigned char type)
{
    if (type == DT_BLK)
        return ('p');
    else if (type == DT_CHR)
        return ('c');
    else if (type == DT_DIR)
        return ('d');
    else if (type == DT_FIFO)
        return ('t');
    else if (type == DT_LNK)
        return ('l');
    else if (type == DT_REG)
        return ('-');
    else if (type == DT_SOCK)
        return ('s');       
 return ('-');
}

char *get_color_of(char type, int mode)
{
	char *color;

	if (type == F_DIR)
		color = ft_strdup("\033[1;36m");
	else if (type == F_LINK)
		color = ft_strdup("\033[0;35m");
	else if(mode & S_IXUSR)
		color = ft_strdup("\033[0;31m");
	else
		color = ft_strdup("\033[0m");
	return (color);
}

void	destroyls(t_folder *folder)
{
	if (!folder)
		return ;
	destroyls(folder->next);
	free(folder->t_file->mode);
	free(folder->t_file->name);
	free(folder->t_file);
	free(folder);
}

void	printls_l(t_folder *folder)
{
		char *color;

		color = get_color_of(get_dtype(folder->t_file->dirent->d_type), folder->t_file->stat.st_mode);
		ft_putstr(folder->t_file->mode);
		ft_putchar('	');
		ft_putstr(folder->t_file->passwd->pw_name);
		ft_putchar('	');
		ft_putstr(folder->t_file->group->gr_name);
		ft_putchar('	');
		ft_putnbr(folder->t_file->stat.st_size);
		ft_putchar('	');
		ft_putstr("*");
		ft_putchar('	');
		ft_putstr(color);
 		ft_putstr(folder->t_file->name);
		ft_putstr(color);
 	 	ft_putstr("\033[0m");
		ft_putchar('\n');
		free(color);	
		folder = folder->next;

}


void	printls_n(t_folder *folder)
{
		char *color;

		color = get_color_of(get_dtype(folder->t_file->dirent->d_type), folder->t_file->stat.st_mode);
		ft_putstr(color);
 		ft_putstr(folder->t_file->name);
		ft_putchar('\n');
 	 	ft_putstr("\033[0m");
		free(color);	
}

void	printls(t_folder *folder, t_opt *opt)
{
	char id;
	int first;

	first = 1;
	id = -1;
	while (folder)
	{
		if(!(opt->flag & F_CACH) && folder->t_file->name[0] == '.')
		{
			folder = folder->next;
			continue;
		}
		if (opt->total > 1  && (id == -1 || folder->id != id))
		{
			first ? 0 : printf("\n");
			ft_putstr(folder->name);
			ft_putstr(":\n");
			first = 0;
			id = folder->id;
		}
		(opt->flag & F_DETA) ? printls_l(folder) : printls_n(folder);
		folder = folder->next;
	}
	printf("\n");
}	